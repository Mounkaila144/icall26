<?php

class languages_ajaxDashboardPositionLanguageAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        try {
            $this->languages = languageUtilsAdmin::getPositionLanguages();
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

