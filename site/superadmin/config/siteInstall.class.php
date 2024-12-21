<?php


class siteInstall extends mfModuleInstall {
    
    
    function execute()
    {      
       $site=$this->getSite();
       // Not install if superadmin
       if (mfConfig::getSuperAdmin('site')!=$site->get('site_db_name'))
       {
           if (mfConfig::get('mf_controller_task',false)) // launch from command ?
                   echo "site module is only for superadmin application\n";
           return false;
       }
       $files=array(
           $this->getModelsPath()."/schema.sql",
           $this->getDataPath()."/data.sql"
       );
       $importDB=importDatabase::getInstance();
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

