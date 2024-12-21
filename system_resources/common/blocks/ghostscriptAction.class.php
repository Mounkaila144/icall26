<?php

class system_resources_ghostscriptActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('ghostscript') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                
             $this->ghostscript=new SystemGhostScript();        
             $this->ghostscript->getVersion();
             if (!$this->ghostscript->hasErrors())
                $settings->setResourceVersion('ghostscript',$this->ghostscript->getVersion());
        }        
    } 
    
    
}