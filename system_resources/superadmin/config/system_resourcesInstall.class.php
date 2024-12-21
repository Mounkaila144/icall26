<?php


class system_resourcesInstall extends mfModuleInstall {
    
    
    function execute()
    {
       $site=$this->getSite();
       $settings= new SystemResourceSettings($site);
       $settings->register('ghostsript','/system_resources/ghostscript');
       $settings->register('wkhtmltopdf','/system_resources/wkhtmltopdf');       
       return true;
    }
    
}

