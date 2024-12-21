<?php


class site_textUninstall extends mfModuleInstall {
    
    function execute()
    {
       
       $importDB=importDatabase::getInstance();
       $site=$this->getSite();
       $files=array(
                   $this->getModelsPath()."/drop.sql",                
                   );              
       foreach ($files as $file)
       {             
         if (is_readable($file))
            $importDB->import($file,$site);
       }       
       return true;
    }
    
}


