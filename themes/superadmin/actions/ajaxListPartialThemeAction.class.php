<?php

class ThemeFormFilter extends mfFormFilterBase {
 
    function configure()
    {
        $this->setDefaults(array(
            'order'=>array(
                            "application"=>"asc",                        
            ),
            'search'=>array(
                         
            ),
            'nbitemsbypage'=>"*",
       ));
       // Base Query
       $this->setQuery("SELECT * FROM ".Theme::getTable()." WHERE application='frontend';");
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "is_active"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                          
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "name"=>new mfValidatorString(array("required"=>false)),                          
                           ),array("required"=>false)),
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
       
    }
    
 
}

class themes_ajaxListPartialThemeAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
     function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();   
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);   
        $this->pager=new Pager('Theme');
        $this->formFilter=new ThemeFormFilter();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));    
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {               
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($this->request->getGetParameter('page'));
                $this->pager->executeSite($site);   
            }
            else
            {               
                $messages->addErrors(array_merge($this->formFilter->getErrorSchema()->getGlobalErrors(),
                                      $this->formFilter->getErrorSchema()->getErrors()));
            }    
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }      
    }

}

