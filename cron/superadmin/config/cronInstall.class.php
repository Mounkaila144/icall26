<?php


class cronInstall extends mfModuleInstall {
    
    
    function execute()
    {
       $site=$this->getSite();
       mfFileSystem::delete(mfConfig::get('mf_site_app_cache_config_dir')."/config_cron.php"); // remove  cache
       // Not install if superadmin
       if (mfConfig::getSuperAdmin('site')!=$site->get('site_db_name'))
       {  
           if (mfConfig::get('mf_controller_task',false))  // launch from command ?
                echo "cron module is only for superadmin application\n";
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

