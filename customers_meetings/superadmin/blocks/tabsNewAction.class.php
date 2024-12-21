<?php

class customers_meetings_tabsNewActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {              
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-new',$this->site)->getTabs();    
      $this->key=$this->getParameter('key');
    } 
    
    
}