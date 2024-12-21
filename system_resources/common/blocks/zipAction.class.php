<?php

class system_resources_zipActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('zip') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                
             $this->zip=new SystemZip();        
           //  $this->zip->getVersion();
           //  if (!$this->zip->hasErrors())
           //     $settings->setResourceVersion('zip',$this->zip->getVersion());
        }        
    } 
    
    
}