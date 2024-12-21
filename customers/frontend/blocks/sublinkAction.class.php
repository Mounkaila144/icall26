<?php

class customers_sublinkActionComponent extends mfActionComponent {

          
    function execute(mfWebRequest $request)
    {  
       if (!$this->sublinks)
       {                    
          $this->urlSource=($request->isXmlHttpRequest())?'urlAjax':'url';
          $this->sublinks=new sublinks(MenuManager::getInstance('customer.dashboard')->getMenu(),$this->urlSource,$request->getPartialURI()); 
          $this->sublinks->build();
       }   
    } 
    
    
    
}