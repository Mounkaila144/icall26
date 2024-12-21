<?php

class utils_ajaxViewTextI18nAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {                          
        $messages = mfMessages::getInstance();       
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$site,"sites","ajaxAdmin"); 
        $class=ucfirst(strtolower($request->getRequestParameter('class')))."TextI18n";
        if (!class_exists($class))
             $this->forward404();   
        $this->class=strtolower($request->getRequestParameter('class'));
        try
        {        
           $this->item=new $class($request->getPostParameter('textI18n'),$site);                                     
           $this->language=$this->getUser()->getLanguage();
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }                  
    }

}

