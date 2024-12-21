<?php

class dashboard_sublinkActionComponent extends mfActionComponent {

          
    function execute(mfWebRequest $request)
    {  
       if (!$this->sublinks)
       {                    
          $this->urlSource=($request->isXmlHttpRequest())?'urlAjax':'url';
          $this->sublinks=new sublinks(menuManager::getInstance('dashboard')->getMenu(),$this->urlSource,$request->getPartialURI()); 
          $this->sublinks->build();
       }   
    } 
    
    
    
}