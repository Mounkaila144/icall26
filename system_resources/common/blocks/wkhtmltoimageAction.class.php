<?php

class system_resources_wkhtmltoimageActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {      
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('wkhtmltoimage') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                
             $this->wkhtmltoimage=new SystemWkhtmltoImage();        
             $this->wkhtmltoimage->getVersion();
             if (!$this->wkhtmltoimage->hasErrors())
                $settings->setResourceVersion('wkhtmltoimage',$this->wkhtmltoimage->getVersion());
        }        
    } 
    
    
}