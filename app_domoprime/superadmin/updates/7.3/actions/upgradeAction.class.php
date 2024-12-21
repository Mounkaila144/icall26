<?php


class app_domoprime_upgrade_73_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();                 
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
