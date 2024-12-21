<?php



class site_upgrade_12_Action extends mfModuleUpdate {
 
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
       $importDB=importDatabase::getInstance();           
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;          
           $importDB->import($file,$site);
           @copy($file, $this->getUpdateDirectory()."/".basename($file));
       }           
    }
}

