<?php

class customers_contracts_tabsNewActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                   
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-new')->getTabs(); 
      $this->user=$this->getUser();
      
    } 
    
    
}