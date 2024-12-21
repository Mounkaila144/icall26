<?php

class LanguagesNewForm extends mfForm {
    
    function configure()
    {       
        $this->setValidators(array(
            'application'=>new mfValidatorChoice(array("choices" => array("admin", "frontend"))),            
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorString(array("max_length" =>2,"min_length"=>2)), count($this->getDefault('selection')),array("required"=>false))
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function reorganize($validator,$values)
    {
        if ($this->getValidatorSchema()->getErrorSchema()->hasErrors())
             return $values;  
        if (!$values['selection'])
            return $values;
        $errors=array();
        foreach ($values['selection'] as $code)
        {    
           if (!in_array($code,languageUtilsAdmin::getLanguagesAllowed()))
           {
               $errors[]=new mfValidatorError($validator,"invalid");
           }                      
        }    
        if ($errors)
           throw new mfValidatorErrorSchema($this->getValidator('selection'),array('selection'=>new mfValidatorErrorSchema($this->getValidator('selection') ,$errors))); 
        return $values;
    }   
    
}
class languages_ajaxNewLanguageAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {        
        if (!$request->isXmlHttpRequest())
            $this->redirect("/superadmin/languages");
        $site = $this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $messages = mfMessages::getInstance();     
        $this->form= new LanguagesNewForm($request->getPostParameter('languages',array('application'=>'frontend')));
        try
        {
        if ($request->isMethod('POST') && $request->getPostParameter('languages'))
        {
            $this->form->bind($request->getPostParameter('languages'));
            if ($this->form->isValid())
            {              
                $languages = new LanguageCollection(null,(string)$this->form['application'], $site);
                foreach ($this->form['selection']->getValue() as $code)
                {
                    $language=new Language(null,(string)$this->form['application'],$site);
                    $language->set('code',$code);
                    $languages[]=$language;
                }    
                $languages->save();
                $messages->addInfo(new mfException("languages added"));
                $this->forward('languages','ajaxListPartial');
            }     
        } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        $this->languages = languageUtilsAdmin::getLanguages((string)$this->form['application'], $site);
        
    }

}

