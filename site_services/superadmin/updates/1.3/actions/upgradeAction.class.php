<?php



class site_services_upgrade_13_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();    
       if (mfConfig::getSuperAdmin('site')!=$site->get('site_db_name'))
       {
           if (mfConfig::get('mf_controller_task',false)) // launch from command ?
                   echo "site module is only for superadmin application\n";
           return false;
       }
       $files=array(
              $this->getModelsPath()."/upgrade.sql",               
              );                           
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;          
           ImportDatabase::getInstance()->import($file,$site);
           @copy($file, $this->getUpdateDirectory()."/".basename($file));
       }           
    }
}

