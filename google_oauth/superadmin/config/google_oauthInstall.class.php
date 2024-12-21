<?php

class google_oauthInstall extends mfModuleInstall {

    function execute()
    {
        $files=array(
            $this->getModelsPath()."/schema.sql",
            $this->getDataPath()."/data.sql"
        );
        $importDB=ImportDatabase::getInstance();
        $site=$this->getSite();
        foreach ($files as $file)
        {
            if (!is_readable($file))
                continue;
             ImportDatabase::getInstance()->import($file,$this->getSite());
            @copy($file, $this->getInstallPath()."/".basename($file));
        }
        UserLoginMethod::register('google','google_oauth');
        return true;
    }
    
}

