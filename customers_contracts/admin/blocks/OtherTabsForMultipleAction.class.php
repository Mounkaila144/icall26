<?php

class customers_contracts_OtherTabsForMultipleActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                     
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-multiple-others')->getSortedTabs();        
    } 
    
    
}