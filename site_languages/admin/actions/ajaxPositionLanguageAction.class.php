<?php

class site_languages_ajaxPositionLanguageAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();           
        try {
            $this->languages = languageUtilsAdmin::getPositionLanguages('frontend');       
        } catch (mfException $e) {
            $messages->addError($e);
        }
        
    }

}

