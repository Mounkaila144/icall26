<?php

class system_resources_pdftkActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('pdftk') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                
             $this->pdftk=new SystemPdftk();        
             $this->pdftk->getVersion();
             if (!$this->pdftk->hasErrors())
                $settings->setResourceVersion('pdftk',$this->pdftk->getVersion());
        }        
    } 
    
    
}