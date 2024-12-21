<?php

class site_languages_dialogListLanguagesAdminActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request)
    {          
        $this->site=$this->getParameter('site');
        $this->languages=LanguageUtilsAdmin::getI18nLanguagesAdmin($this->site);              
        $this->selected=(string)$this->getParameter('selected',$this->getUser()->getLanguage());
        $this->name=$this->getParameter('id');       
    } 
    
    
}


