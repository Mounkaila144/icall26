<?php

class customers_contracts_tabsPanelNewActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                       
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-new')->getComponents(); 
      $this->user=$this->getUser();      
    } 
    
    
}