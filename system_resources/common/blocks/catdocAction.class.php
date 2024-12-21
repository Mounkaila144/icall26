<?php

class system_resources_catdocActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('catdoc') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                          
             $this->resource=new SystemCatdoc();        
             $this->resource->getVersion();
             if (!$this->resource->hasErrors())
                $settings->setResourceVersion('catdoc',$this->resource->getVersion());
        }        
    } 
    
    
}