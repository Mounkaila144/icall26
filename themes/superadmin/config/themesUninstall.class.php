<?php


class themesUninstall extends mfModuleInstall {
    
    
    function execute()
    {
       $importDB=importDatabase::getInstance();
       $site=$this->getSite();
       $files=array($this->getModelsPath()."/drop.sql");
       if (mfConfig::getSuperAdmin('site')==$site->get('site_db_name'))
           $files[]=$this->getModelsPath()."/drop_superadmin.sql";
       foreach ($files as $file)
       {    
         if (is_readable($file))
             $importDB->import($file,$site);
       }  
       return true;
    }
    
}

