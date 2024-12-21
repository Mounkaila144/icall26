<?php


class app_domoprime_upgrade_11_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();     
       if (!mfModule::isModuleInstalled('partners_polluter',$site))
       {
          $module=new mfModule('modules_manager',$site); 
          $module->getInstaller()->upgrade(); 
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

