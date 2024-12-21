<?php

class customers_contracts_tabsPanelActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {              
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-view',$this->site)->getComponents(); 
      $this->key=$this->getParameter('key');             
    } 
    
    
}