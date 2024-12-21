<?php


class site_companyUninstall extends mfModuleInstall {
    
    
    function execute()
    {
       $importDB=ImportDatabase::getInstance();
       $site=$this->getSite();
       $file=$this->getModelsPath()."/drop.sql";
       if (is_readable($file))
           $importDB->import($file,$site);
       return true;
    }
    
}

