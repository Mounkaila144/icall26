<?php

class system_resources_pdfimagesActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('pdfimages') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                          
             $this->resource=new SystemPdfImages();        
             $this->resource->getVersion();
             if (!$this->resource->hasErrors())
                $settings->setResourceVersion('pdfimages',$this->resource->getVersion());
        }        
    } 
    
    
}