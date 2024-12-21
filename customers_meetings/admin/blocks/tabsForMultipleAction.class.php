<?php

class customers_meetings_tabsForMultipleActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                     
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-multiple')->getSortedTabs();        
    } 
    
    
}