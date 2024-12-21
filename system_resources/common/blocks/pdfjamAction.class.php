<?php

class system_resources_pdfjamActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('pdfjam') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                
             $this->pdfjam=new SystemPdfJam();        
             $this->pdfjam->getVersion();
             if (!$this->pdfjam->hasErrors())
                $settings->setResourceVersion('pdfjam',$this->pdfjam->getVersion());
        }        
    } 
    
    
}