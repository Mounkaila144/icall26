<?php

class app_domoprime_iso_DashboardMenuIsoSettingsItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
       // MenuManager::getInstance('Dashboard')->getMenu()->findAndDisable("90_app_domoprime_configuration_settings");       
    //   MenuManager::getInstance('Dashboard')->getMenu()->findAndDisable('70_app_domoprime_configuration_documents'); 
         $this->item=$this->getParameter('item');        
    } 
    
    
}