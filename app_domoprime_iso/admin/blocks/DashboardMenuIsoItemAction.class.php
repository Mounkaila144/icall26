<?php

class app_domoprime_iso_DashboardMenuIsoItemActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
       MenuManager::getInstance('site.dashboard')->getMenu()->findAndDisable('site_domoprime.30_settings');       
       MenuManager::getInstance('site.dashboard')->getMenu()->findAndDisable('site_domoprime.15_documents'); 
        $this->item=$this->getParameter('item');        
    } 
    
    
}