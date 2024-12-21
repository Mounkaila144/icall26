<?php


class app_domoprime_upgrade_32_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite(); 
       
       // install le module       
       $module_manager=new ModuleManager('partners_recipient',$site);
       $module_manager->setConfigFromModule(); 
       $module_manager->save();
       $module_manager->getModule()->getInstaller()->upgrade();
       $module_manager->set('status','installed');
       $module_manager->save();   
       
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

