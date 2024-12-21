<?php

class site_textInstall extends mfModuleInstall {
    
    function execute()
    {        
       $site=$this->getSite();                                  
       $files=array(
              $this->getModelsPath()."/schema.sql",                  
             // $this->getDataPath()."/data.sql",              
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
