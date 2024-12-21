<?php



class site_servicesUninstall extends mfModuleInstall {
    
    function execute()
    {
       $site=$this->getSite();
       if (mfConfig::getSuperAdmin('site')!=$site->get('site_db_name'))
       {
           if (mfConfig::get('mf_controller_task',false)) // launch from command ?
                   echo "this module is only for superadmin application\n";
           return false;
       }      
        $importDB=importDatabase::getInstance();
       $file=$this->getModelsPath()."/drop.sql";
       if (is_readable($file))
           $importDB->import($file,$site);
       return true;
    }
    
}


