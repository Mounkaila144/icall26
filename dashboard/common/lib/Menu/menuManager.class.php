<?php


class MenuManager {

    protected static $instances=array();
    protected $menu=null,$site=null;
    
    static function getInstance($name,$site=null)
    {        
        if ($site && !$site instanceof Site)
           throw new mfException("site is invalid in menu manager.");   
        if ($site)
           $key=$site->getHost().".".$name;  
       else 
           $key=$name;
        if (self::$instances[$key])
            return self::$instances[$key];
        else
        {
            self::$instances[$key]=new MenuManager($name,$site);
            return self::$instances[$key];
        }    
    } 
       
    
    function __construct($name,$site=null) {
        $context=mfContext::getInstance();
        $request=$context->getRequest();     // DONOT REMOVE USED IN MENU CONFIG            
        if ($site==null)
            require_once $context->getConfigCache()->checkConfig('config/menu.php',$name,$name); 
        else                       
            require_once $context->getFactory('configCacheSite')->checkConfig('config/menu.php',$name,$name,$site);          
    }
    
    function getMenu()
    {
      return $this->menu;
    }
       
    
    static function removeCache(Site $site)
    {        
        // remove config_menu ...  in root and in site and in all application            
        $files=array_merge(
                           // Superadmin
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.mfConfig::getSuperAdmin('host').'/*/*/config/config_menu_'.$site->getHost().'*.php'),                          
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.mfConfig::getSuperAdmin('host').'/*/*/config/'.$site->getHost().'/config_menu*.php'),
                           // On admin & frontend of site
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getHost().'/*/*/config/config_menu_*.php'),
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getHost().'/*/*/config/config_menu*.php')
                          );                                 
        mfFileSystem::delete_files($files);
        // remove i18n        
        MenuTranslator::removeCache('menus',$site);
    }
    
    
    
   
}

