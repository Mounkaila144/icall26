<?php

class site_tabsDashboardSiteActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {              
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
      $this->tabs=TabsManager::getInstance('dashboard.site',$this->site);    
    } 
    
    
}