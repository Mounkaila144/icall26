<?php

class customers_contracts_tabsForMultipleActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                     
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-multiple')->getSortedTabs();        
    } 
    
    
}