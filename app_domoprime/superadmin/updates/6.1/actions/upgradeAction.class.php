<?php


class app_domoprime_upgrade_61_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();    
       // Install site company document
       if (!mfModule::isModuleInstalled('site_company_document',$site))
       {
                $module = new ModuleManager(array('name'=>'site_company_document'),$site);
                if($module->isNotLoaded())
                     $module->add(array('name'=>'site_company_document','is_available'=>'YES','is_active'=>'YES','type'=>'site','logo'=>'logo.png'))->save();
                $module->getModule()->getInstaller()->upgrade();    
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

