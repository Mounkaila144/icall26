<?php

class AddThemeForm extends mfFormSite 
{

    protected $themes=null,$themes_admin=null;
    
    function __construct($defaults = array(),  $site = null) {
        parent::__construct($defaults, array(), $site);
    }
    
    function configure() { 
                       
        $this->setValidators(array(                      
            "selection"=>new mfValidatorSchemaForEach(new mfValidatorString(array('max_length'=>30)),count($this->getDefault('selection'))),           
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'check'))));
    }
    
    function check($validator,$values)
    {
        if ($this->errorSchema->hasErrors())
             return $values;
        $themes_authorized=$this->getThemesAdmin()->getNames();
        $themes_existing=$this->getThemesNames();
        $themes_error=array();
        $themes=array();
        foreach ($values['selection'] as $name)
        {
             if (!in_array($name,$themes_existing) && in_array($name,$themes_authorized))
             {                               
                 $themes[]=$name;
             }                   
             elseif (!in_array($name,$themes_authorized) && !in_array($name,$themes_existing))
             {
                 $themes_error[]=$name; 
             }                                                             
        }     
        if ($themes_error)
        {
           $this->errorSchema->addError(new mfValidatorError($this->selection,
                                                             __("Themes [{themes}] don't exist."),array('themes'=>implode(",",$themes_error))),
                                                             'selection');     
        }    
        if ( $this->errorSchema->hasErrors())
             throw $this->errorSchema;     
        $values['selection']=$themes;
        return $values;
    }
     
    function getThemesAdminNamesI18n()    
    {      
       $this->getThemesAdmin();
       if ($this->themes_admin)
            return $this->themes_admin->getNamesI18n();      
       return array();
    }
    
    function getThemesNames()
    {
       $this->getThemes();
       $names=array();
       foreach ($this->themes as $theme)
         $names[]=$theme->get('name');
       return $names;
    }
    
    function getThemesAdmin()
    {
       if (!$this->themes_admin)
       {
        $this->themes_admin=ThemesUtils::getFrontendThemesNotInThemes($this->getThemes());
       }
       return $this->themes_admin;
    }
    
    function getThemes()
    {
       if (!$this->themes)
       {        
            $this->themes= ThemeUtils::getThemes('frontend',$this->getSite());
       }      
       return $this->themes;
    }
    
}

class themes_ajaxAddThemeAction extends mfAction 
{
    
    const SITE_NAMESPACE = 'system/site';    
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();  
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$site,"site","Admin");      
        try
        { 
            $this->form=new AddThemeForm($request->getPostParameter('AddThemes'),$site);    
            if ($request->isMethod('POST') && $request->getPostParameter('AddThemes'))
            {
                $this->form->bind($request->getPostParameter('AddThemes'));
                if ($this->form->isValid())
                {
                    $themes=new ThemeFrontendCollection(null,$site);
                    foreach ($this->form->getValue('selection') as $name)
                    {       
                        $theme=new ThemeFrontend(null,$site);
                        $theme->setTheme($this->form->getThemesAdmin()[$name]);                       
                        $themes[]=$theme;
                    }             
                    $messages->addInfo(__('Themes have been added.'));
                    $themes->save();                  
                    $this->forward('themes','ajaxListPartialTheme');
                }   
                else
                {                      
                      $messages->addError($this->form['selection']->getError()); 
                }    
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e); 
        }      
    }
}

