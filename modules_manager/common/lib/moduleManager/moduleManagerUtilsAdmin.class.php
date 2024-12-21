<?php

 
class moduleManagerUtilsAdmin {
       
    // @TODO a mettre en cache
    static function getModules()
    {
        $db=mfSiteDatabase::getInstance();
        $db->setQuery("SELECT name FROM ".  ModuleManager::getTable()." WHERE is_active='YES' AND is_available='YES';")               
             ->makeSqlQuery();     
        if (!$db->getNumRows())
           return array();
        $modules=array();
        while ($item=$db->fetchArray())
        {           
            $modules[$item['name']]=true;            
        }                  
        return $modules;
    }
    static function getAllModules()
    {
        $db=mfSiteDatabase::getInstance();
        $db->setQuery("SELECT name FROM ".  ModuleManager::getTable()." ;")               
             ->makeSqlQuery();     
        if (!$db->getNumRows())
           return array();
        $modules=array();
        while ($item=$db->fetchArray())
        {           
            $modules[$item['name']]=true;            
        }                  
        return $modules;
    }
    
    function removeConfigCache(Site $site)
    {
        //   /[application]/[environnement]/config/module_[module]_config_module_[action].php  // module/action
        //   /[application]/[environnement]/config/module_[module]_config_module.php  // module (block)
        $files=array_merge(glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getSiteName()."/frontend/*/config/module_*_config_module_*.php"),
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getSiteName()."/frontend/*/config/module_*_config_module.php"),
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getSiteName()."/admin/*/config/module_*_config_module_*.php"),
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getSiteName()."/admin/*/config/module_*_config_module.php")
                          ); 
        //var_dump($files);  return ;
        foreach ($files as $file)
        {
             if (is_readable($file)) 
                unlink($file);
        } 
    }
    
    function removeConfigCacheAllSites()
    {
        //   /[application]/[environnement]/config/module_[module]_config_module_[action].php  // module/action
        //   /[application]/[environnement]/config/module_[module]_config_module.php  // module (block)
        $files=array_merge(glob(mfConfig::get('mf_cache_dir')."/sites/*/frontend/*/config/module_*_config_module_*.php"),
                           glob(mfConfig::get('mf_cache_dir')."/sites/*/frontend/*/config/module_*_config_module.php"),
                           glob(mfConfig::get('mf_cache_dir')."/sites/*/admin/*/config/module_*_config_module_*.php"),
                           glob(mfConfig::get('mf_cache_dir')."/sites/*/admin/*/config/module_*_config_module.php")
                ); 
        //var_dump($files);  return ;
        foreach ($files as $file)
        {
             if (is_readable($file)) 
                unlink($file);
        } 
    }
    
    
    static function getModulesForType($type,$site=null)
    {
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('type'=>$type))
           ->setQuery("SELECT * FROM ".  ModuleManager::getTable().
                      " WHERE is_active='YES' AND is_available='YES' AND type='{type}'".
                      ";")               
           ->makeSiteSqlQuery($site);     
        if (!$db->getNumRows())
           return array();
        $modules=array();
        while ($item=$db->fetchObject('ModuleManager'))
        {           
            $item->site=$site;
            $modules[$item->get('name')]=$item->loaded();            
        }                  
        return $modules;
    }
 
}
