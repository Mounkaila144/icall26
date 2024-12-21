<?php

class customers_contracts_tabsPanelActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                    
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-view')->getComponents(); 
      // var_dump($this->tabs);
      $this->key=$this->getParameter('key');   
      $this->user=$this->getUser();
    } 
    
    
}