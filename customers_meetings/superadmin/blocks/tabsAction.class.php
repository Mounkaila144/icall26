<?php

class customers_meetings_tabsActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {              
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-view',$this->site)->getSortedTabs();    
      $this->key=$this->getParameter('key');
    } 
    
    
}