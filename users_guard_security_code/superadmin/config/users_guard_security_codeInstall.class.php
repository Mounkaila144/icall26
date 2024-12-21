<?php

class users_guard_security_codeInstall extends mfModuleInstall {
    
    function execute()
    {
        $site=$this->getSite();
        if (mfConfig::getSuperAdmin('site')!=$site->get('site_db_name'))
            return true;
        $files=array(
            $this->getModelsPath()."/schema.sql",              
        );                       
        foreach ($files as $file)
        {    
            if (!is_readable($file))
                continue;
            ImportDatabase::getInstance()->import($file,$site);
            @copy($file, $this->getInstallPath()."/".basename($file));
        }
        return true;
    }
}

