<?php

class utils_ajaxViewTextEmailI18nAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {                          
        $messages = mfMessages::getInstance();       
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$site,"sites","ajaxAdmin");         
        try
        {        
           $this->item=new TextEmailI18n($request->getPostParameter('textEmailI18n'),$site);                                               
           $this->language=$this->getUser()->getLanguage();
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }                  
    }

}

