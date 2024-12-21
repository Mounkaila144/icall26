<?php

class site_menuActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {          
       $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
       $this->menu= MenuManager::getInstance('site',$this->site)->getMenu();          
       $this->user=$this->context->getUser();          
    }
    
}