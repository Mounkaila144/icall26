<?php

class languages_ajaxPositionLanguageFrontendAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();           
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$site,"sites","Admin");   // Save, Cancel, User 
        try {
            $this->languages = languageUtilsAdmin::getPositionLanguages('frontend',$site);
         //   var_dump($this->languages);
          //  $fr=new Language("fr");
         //   $en=new Language("en");
         //   var_dump($fr,$en);
            
         //   $fr->moveTo($en)->save();
            
        } catch (mfException $e) {
            $messages->addError($e);
        }
        
    }

}

