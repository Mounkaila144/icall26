<?php

class site_languages_dialogListLanguagesFrontendActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request)
    {          
        $this->languages=languageUtilsAdmin::getI18nLanguagesFrontend();              
        $this->selected=(string)$this->getParameter('selected',$this->getUser()->getLanguage());
    } 
    
    
}


