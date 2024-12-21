<?php


class site_companyInstall extends mfModuleInstall {
    
    
    function execute()
    {
       $files=array(
           $this->getModelsPath()."/schema.sql",
           $this->getDataPath()."/data.sql"
       );
       $importDB=ImportDatabase::getInstance();
       $site=$this->getSite();
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;
           $importDB->import($file,$site);
           @copy($file, $this->getInstallPath()."/".basename($file));
       }
       return true;
    }
    
}

