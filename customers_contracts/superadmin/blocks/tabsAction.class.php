<?php

class customers_contracts_tabsActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {              
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-view',$this->site)->getTabs();    
      $this->key=$this->getParameter('key');          
    } 
    
    
}