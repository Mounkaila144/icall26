<?php

class system_resources_nodejsActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('node.js') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                          
             $this->nodejs=new SystemNodeJs();        
             $this->nodejs->getVersion();     
             if (!$this->nodejs->hasErrors())
                $settings->setResourceVersion('node.js',$this->nodejs->getVersion());
        }        
    } 
    
    
}