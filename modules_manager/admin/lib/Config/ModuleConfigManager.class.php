<?php



class ModuleConfigManager extends mfModuleManagerBase {
    
    function getModulesAvailableFromDatabase($modules)
    {
        $db=mfSiteDatabase::getInstance();
        $db->setQuery("SELECT name FROM ".  ModuleManager::getTable()." WHERE (is_active='YES' AND is_available='YES'".
                            " AND name IN('".implode("','",$modules)."'))".
                            " OR type IN('core','base','system');")               
             ->makeSqlQuery();     
        if (!$db->getNumRows())
           return ;        
        while ($item=$db->fetchArray())
        {           
            $this->modules[$item['name']]=true;            
        }                         
    }
    
    function getConfigFiles($files)
    {        
        // modules_manager module has to be installed
        if (!mfModule::isModuleInstalled('modules_manager'))
            return $files;
        $configFiles=array();  
        $modulesToLoad=array();                            
        $modules=$this->getModulesFromConfigFiles($files);               
        // Build config list for existing installed and enabled modules
        foreach ($modules as $module)
        {
            // No need to load from DB if module is core
            if (mfModule::getInstance($module->getModule())->isCore())
            {
                $this->modules[$module->getModule()]=true;
                continue;
            }    
            if (!$this->hasModule($module->getModule()))            
            {
                $modulesToLoad[]=$module->getModule();
            }                     
        }        
        // Get modules not in class list from DB 
        $this->getModulesAvailableFromDatabase($modulesToLoad);             
        // Build config list from modules not yet in list
        foreach ($modules as $module)
        {              
            if ($this->hasModule($module->getModule()))            
            {
                $configFiles[]=$module->getConfigFile();
            }                     
        }        
        return $configFiles;
    }    
}