<?php

class SiteCacheAdmin {

    static function clearCache() {
        self::clearCacheApplications();
        self::clearCacheSites();
        self::clearCacheDatabases();
    }

    static function clearCacheApplications() {
        foreach (glob(mfConfig::get('mf_apps_dir') . "/*", GLOB_ONLYDIR) as $app) {
            $app = basename($app);
            if (!is_dir(mfConfig::get('mf_cache_dir') . '/' . $app))
                continue;           
            self::clearCacheApplication($app);
        }
    }

    static function clearCacheApplication($app) {
        foreach (glob(mfConfig::get('mf_cache_dir') . '/' . $app . "/*", GLOB_ONLYDIR) as $env) {
            $env = basename($env);
            if (!is_dir(mfConfig::get('mf_cache_dir') . '/' . $app . "/" . $env))
                continue;
            self::clearCacheApplicationEnvironnement($app, $env);
        }
    }

    static function clearCacheApplicationEnvironnement($app, $env) {
        self::lock($app, $env);
        mfFileSystem::net_rmdir(mfConfig::get('mf_cache_dir') . '/' . $app . "/" . $env);
        self::unlock($app, $env);
    }

    static function clearCacheSites() {
        foreach (glob(mfConfig::get('mf_cache_dir') . "/sites/*", GLOB_ONLYDIR) as $site) {            
            self::clearCacheSite(basename($site));
        }
    }

    static function clearCacheDatabases()
    {
      foreach (glob(mfConfig::get('mf_cache_dir')."/databases/*") as  $file)
           unlink($file);
    }
    
    static function clearCacheSite($site) {
        if ($site instanceof Site)
            $site=$site->getHost();
        foreach (glob(mfConfig::get('mf_apps_dir') . "/*", GLOB_ONLYDIR) as $app) {
            $app = basename($app);
            if (!is_dir(mfConfig::get('mf_cache_dir') . '/sites/' . $site . "/" . $app))
                continue;
            self::clearCacheSiteApplication($site, $app);
        }
    }

    static function clearCacheSiteApplication($site, $app) {
        foreach (glob(mfConfig::get('mf_cache_dir') . '/sites/' . $site . "/" . $app . "/*", GLOB_ONLYDIR) as $env) {
            $env = basename($env);
            if (!is_dir(mfConfig::get('mf_cache_dir') . '/sites/' . $site . "/" . $app . "/" . $env))
                continue;
            self::clearCacheSiteApplicationEnvironnement($site, $app, $env);
        }
    }

    static function clearCacheSiteApplicationEnvironnement($site, $app, $env) {
        self::lock($app, $env, $site);
        mfFileSystem::net_rmdir(mfConfig::get('mf_cache_dir') . '/sites/' . $site . '/' . $app . "/" . $env);
        self::unlock($app, $env, $site);
    }

    static protected function getLockFile($app, $env, $host=null) {
        if ($host == null)
            return mfConfig::get('mf_config_dir') . '/' . $app . '_' . $env . '-cli.lck';
        return mfConfig::get('mf_config_dir') . '/' . $host . '_' . $app . '_' . $env . '-cli.lck';
    }

    static protected function unlock($app, $env, $host=null) {
        // release lock
        unlink(self::getLockFile($app, $env, $host));
    }

   static protected function lock($app, $env, $host=null) {
        // create a lock file
        file_put_contents(self::getLockFile($app, $env, $host),"");
        // change mode so the web user can remove it if we die
       // chmod($this->getLockFile($app, $env, $host), 0777);
    }
    
    static function clearHostCache()
    {             
         foreach (glob(mfConfig::get('mf_cache_dir')."/*/hosts/*.cache") as $file)
         {
             unlink($file);
         }                 
    }
    
}




