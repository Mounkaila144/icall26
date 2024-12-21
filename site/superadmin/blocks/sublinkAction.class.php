<?php

class site_sublinkActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
   {               
           $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        //  $this->urlSource=($request->isXmlHttpRequest())?'urlAjax':'url';          
        //  $this->sublinks=new sublinks(MenuManager::getInstance('site',$this->site)->getMenu(),$this->urlSource,$request->getPartialURI()); 
        //  $this->sublinks->build();  
          $this->sublinks=MenuManager::getInstance('site.dashboard',$this->site)->getMenu()->getSublinks($request->getParameter('route_full'),$request->isXmlHttpRequest());       
    } 
    
    
    
}