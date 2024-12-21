<?php
 

class CacheFile extends mfCacheFile {
              
   static function removeAll($application = null, $site = null) 
    {

         if ($site == null)
            $site = mfConfig::get('mf_site_host');
        if ($site instanceof Site)
            $site = $site->get('site_host');
        if ($application==null)
            $application=mfConfig::get('mf_app'); 
        $pattern=sprintf("%s/sites/%s/%s/%s/data/",
                mfConfig::get('mf_cache_dir'),$site,$application,mfConfig::get('mf_environment'));             
        $files = glob($pattern);
        mfFileSystem::net_rmdir($pattern);
      
    }
}


