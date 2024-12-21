<?php


class tabsManager {

    protected static $instances=array();
    protected $tabs=null,$components=null;
    
    static function getInstance($name,$site=null)
    {
       if ($site && !$site instanceof Site)
           throw new mfException("Site is invalid in tab manager.");   
       if ($site)
           $key=$site->getHost().".".$name;  
       else 
           $key=$name;
       if (self::$instances[$name])
            return self::$instances[$name];
       else
       {
            self::$instances[$name]=new self($name,$site);
            return self::$instances[$name];
       }    
    } 
    
    function __construct($name,$site=null) { 
       $context=mfContext::getInstance(); // Used to config tab file
       $request=$context->getRequest();  // Used to config tab file       
       if ($site==null)
           require_once $context->getConfigCache()->checkConfig('config/tabs.php',$name,$name); 
       else                       
           require_once $context->getFactory('configCacheSite')->checkConfig('config/tabs.php',$name,$name,$site);      
    }
    
    function getTabs()
    {
      return $this->tabs;
    }
    
    function getSortedTabs()
    {
      ksort($this->tabs);
      return $this->tabs;
    }
    
    function hasTabs()
    {
        return !empty($this->tabs);
    }
    
    function getComponents()
    {
        if ($this->components===null)
        {    
            $this->components=array();
            foreach ($this->tabs as $name=>$tab)
            {
                if (isset($tab['component']))
                    $this->components[$name]=$tab;
            }
        }
        return $this->components;
    }
    
    function getModules()
    {
        if ($this->modules==null)
        {    
            $this->modules=new mfArray();
            foreach ($this->getComponents() as $tab) 
            {
                $module=basename(dirname($tab['component']));               
                if (isset($this->modules[$module]))
                    continue;
                $this->modules[$module]=$module;
            }    
        }
        return $this->components;
    }
         
    static function removeCache(Site $site)
    {
        // remove config_menu ...  in root and in site and in all application    
        $files=array_merge(// Superadmin
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.mfConfig::getSuperAdmin('host').'/*/*/config/config_tabs_'.$site->getHost().'*.php'),                          
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.mfConfig::getSuperAdmin('host').'/*/*/config/'.$site->getHost().'/config_tabs*.php'),
                           // Site
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getHost().'/*/*/config/config_tabs_*.php'),
                           glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getHost().'/*/*/config/config_tabs*.php')
                          ); 
     //   var_dump($files); 
        foreach ($files as $file)
        {
            if (is_readable($file)) 
                unlink($file);
        }   
        // remove i18n        
        TabsTranslator::removeCache('tabs',$site);
    }
    
    function loadTexts($catalog="messages")
    {        
        mfContext::getInstance()->getI18n()->loadCatalogForModules($this->getModules(),$catalog);
        return $this;
    }
  
}