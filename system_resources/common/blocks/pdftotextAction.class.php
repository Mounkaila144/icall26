<?php

class system_resources_pdftotextActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('pdftotext') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                          
             $this->resource=new SystemPdfToText();        
             $this->resource->getVersion();
             if (!$this->resource->hasErrors())
                $settings->setResourceVersion('pdftotext',$this->resource->getVersion());
        }        
    } 
    
    
}