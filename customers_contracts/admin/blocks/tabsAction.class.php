<?php

class customers_contracts_tabsActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {                     
       $this->tabs=TabsManager::getInstance('dashboard-site-customers-contract-view')->getSortedTabs();    
       $this->key=$this->getParameter('key');
       $this->user=$this->getUser(); 
    /* foreach($this->tabs as $tab){
          var_dump($tab->get('credentials'));  
         echo "<br>";
      }*/
    } 
    
    
}