<?php


class site_services_tabsServicesActionsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                               
      $this->tabs=TabsManager::getInstance('dashboard-site-services'); 
      $this->user=$this->getUser();            
    } 
    
    
}