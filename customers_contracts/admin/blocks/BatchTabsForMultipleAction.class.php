<?php

class customers_contracts_BatchTabsForMultipleActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                     
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-multiple-batch')->getSortedTabs();        
    } 
    
    
}