<?php

class site_languages_dialogListLanguagesFrontendActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request)
    {          
        $this->site=$this->getParameter('site');
        $this->languages=LanguageUtilsAdmin::getI18nLanguagesFrontend($this->site);              
        $this->selected=(string)$this->getParameter('selected',$this->getUser()->getLanguage());
        $this->name=$this->getParameter('id');       
    } 
    
    
}


