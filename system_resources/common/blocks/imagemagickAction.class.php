<?php

class system_resources_imagemagickActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {           
        $settings=$this->getParameter('settings');
        if (!$settings->isResourceValidated('imagemagick') ||  $request->getRequestParameter('system_resources_check','NO')=='YES')
        {                
             $this->imagemagick=new SystemImageMagick();        
             $this->imagemagick->getVersion();
             if (!$this->imagemagick->hasErrors())
                $settings->setResourceVersion('imagemagick',$this->imagemagick->getVersion());
        }        
    } 
    
    
}