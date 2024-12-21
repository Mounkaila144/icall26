<?php

class languages_ajaxPositionLanguageAdminAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();           
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$site,"sites","Admin");   // Save, Cancel, User 
        try {
            $this->languages = languageUtilsAdmin::getPositionLanguages('admin',$site);                
        } catch (mfException $e) {
            $messages->addError($e);
        }
        
    }

}

