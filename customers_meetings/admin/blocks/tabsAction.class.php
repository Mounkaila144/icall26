<?php

class customers_meetings_tabsActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {                     
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-view')->getSortedTabs();   
      $this->user=$this->getUser();
      $this->key=$this->getParameter('key');
    } 
    
    
}