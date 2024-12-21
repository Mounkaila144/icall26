<?php


class system_resourcesUninstall extends mfModuleInstall {
    
    
    function execute()
    {
       $importDB=importDatabase::getInstance();
       $site=$this->getSite();
       $file=$this->getModelsPath()."/drop.sql";
       if (is_readable($file))
           $importDB->import($file,$site);       
       $settings= new SystemResourceSettings($site);
       $settings->delete();
       return true;
    }
    
}

