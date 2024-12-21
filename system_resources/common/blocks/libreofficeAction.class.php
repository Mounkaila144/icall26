<?php

class system_resources_libreofficeActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
         if (!$settings->isResourceValidated('libreoffice') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
         {                   
             $this->libreoffice=new SystemLibreOffice();        
             $this->libreoffice->getVersion();
             if (!$this->libreoffice->hasErrors())
                $settings->setResourceVersion('libreoffice',$this->libreoffice->getVersion());
         }        
    } 
    
    
}