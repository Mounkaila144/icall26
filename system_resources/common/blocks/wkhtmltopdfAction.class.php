<?php

class system_resources_wkhtmltopdfActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('wkhtmltopdf') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                
             $this->wkhtmltopdf=new SystemWkhtmltopdf();        
             $this->wkhtmltopdf->getVersion();
             if (!$this->wkhtmltopdf->hasErrors())
                $settings->setResourceVersion('wkhtmltopdf',$this->wkhtmltopdf->getVersion());
        }        
    } 
    
    
}