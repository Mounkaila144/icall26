<?php


class app_domoprime_iso_upgrade_29_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();                 
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

