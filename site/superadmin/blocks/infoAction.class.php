<?php

class site_infoActionComponent extends mfActionComponent {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request)
    {
         $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE); 
    } 
    
   
}

