<?php

class customers_meetings_tabsPanelActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {              
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
      $this->tabs=TabsManager::getInstance('dashboard-site-customers-meeting-view',$this->site)->getComponents(); 
      $this->key=$this->getParameter('key');    
    } 
    
    
}