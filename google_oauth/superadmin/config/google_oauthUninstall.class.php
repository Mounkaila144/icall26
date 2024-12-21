<?php


class google_oauthUninstall extends mfModuleInstall {
    
    
    function execute()
    {
       $importDB=ImportDatabase::getInstance();
       $site=$this->getSite();
       $file=$this->getModelsPath()."/drop.sql";
       if (is_readable($file))
            ImportDatabase::getInstance()->import($file,$this->getSite());
       return true;
    }
    
}

