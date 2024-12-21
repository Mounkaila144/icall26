<?php

class site_menuDashboardSiteActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {              
       $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE); 
       $this->menu= MenuManager::getInstance('site.dashboard',$this->site)->getMenu();
       $this->user=$this->context->getUser();   
    //   var_dump($this->menu);
    } 
    
    
}