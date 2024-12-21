<?php

class SiteBase  extends mfObject2 {
    
    protected static $fields=array( 'site_host','site_db_name','site_admin_theme','site_frontend_theme','site_type','site_master',
                                    'site_admin_available','site_frontend_available','site_available','site_db_host','site_db_login',
                                    'site_company','is_customer',
                                    'last_connection','price',
                                    'site_db_size','site_size','is_uptodate',
                                    'site_frontend_theme_base','site_admin_theme_base','logo','picture',
                                    'site_db_password','site_access_restricted'
                                  );
    const key="site_id",table="t_sites";
    protected static $fieldsNull=array('last_connection');
    
    function __construct($parameters=null)
    {    
      $this->getDefaults();
      if ($parameters===null)  return $this;
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      { // PRIMARY KEY
         if (isset($parameters['site_id']))
             return  $this->loadbyId((string)$parameters['site_id']); 
         if (isset($parameters['site_host']))
             return  $this->loadbyHost((string)$parameters['site_host']); 
         if (isset($parameters['site_db_name']))
             return  $this->loadbyName((string)$parameters['site_db_name']);
         return $this->add($parameters); 
      }   
      else
      {
        if (is_numeric((string)$parameters))
           return $this->loadbyId((string)$parameters);  
        return $this->loadbyHost((string)$parameters);
      }  
    } 
    
    protected function loadbyHost($host) {
        $this->set('site_host',$host);
        $db=mfSiteDatabase::getInstance();       
        $db->setParameters(array($host))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE site_host='%s' LIMIT 1;")
                 ->makeSqlQuerySuperAdmin();   
        return  $this->rowtoObject($db);
    }
    
     protected function loadbyName($name) {
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array($name))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE site_db_name='%s' LIMIT 1;")
                 ->makeSqlQuerySuperAdmin();   
        return  $this->rowtoObject($db);
    }
    
     protected function executeLoadById($db) 
     {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d LIMIT 1;")
           ->makeSqlQuerySuperAdmin();  
     }
    
    protected function loadDatabase($database)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($database))
                ->setQuery("SELECT site_db_login,site_db_password,site_db_host FROM ".self::getTable()." WHERE site_db_name='%s' LIMIT 1;")
                ->makeSqlQuerySuperAdmin(); 
        $this->rowtoObject($db);
    }     
      
    protected function getDefaults()
    {
       $this->site_admin_available=isset($this->site_admin_available)?$this->site_admin_available:"NO";
       $this->site_frontend_available=isset($this->site_frontend_available)?$this->site_frontend_available:"NO";
       $this->site_admin_theme=isset($this->site_admin_theme)?$this->site_admin_theme:"default";
       $this->site_admin_theme_base=isset($this->site_admin_theme_base)?$this->site_admin_theme_base:"default";
       $this->site_type=isset($this->site_type)?$this->site_type:"CUST";
       $this->site_frontend_theme=isset($this->site_frontend_theme)?$this->site_frontend_theme:"default";
       $this->site_frontend_theme_base=isset($this->site_frontend_theme_base)?$this->site_frontend_theme_base:"default";
       $this->site_available=isset($this->site_available)?$this->site_available:"NO";
       $this->is_customer=isset($this->is_customer)?$this->is_customer:"YES";
    }
    
    protected function insert()
    {
       if (!isset($this->site_db_login)&&!isset($this->site_db_password)&&!isset($this->site_db_host)) // Case HOST creation
       {        
            $this->loadDatabase($this->site_db_name);
       }   
       parent::insert();
    }
    
    protected function executeInsertQuery($db)
    {
        $db->makeSqlQuerySuperAdmin();  
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
           ->makeSqlQuerySuperAdmin();   
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSqlQuerySuperAdmin();     
    }
    
    protected function executeIsExistQuery($db) {
        $db = mfSiteDatabase::getInstance()
                ->setParameters(array($this->getHost()))
                ->setQuery("SELECT site_id FROM ".self::getTable()." WHERE site_host='%s';")
                ->makeSqlQuerySuperAdmin();
    }

    /* ********************************************************************************************** */
    function getHost()
    {
        return $this->site_host;
    }
    
   /* function getSiteID() {
        return $this->site_id;
    }*/

    function getSiteName() {
        return $this->site_db_name;
    }

 /*   function getThemeAdmin() {
        return $this->site_admin_theme;
    }

    function getThemeFrontEnd() {        
        return $this->site_frontend_theme;
    }*/

    function getType() {
        return $this->site_type;
    }

    function getMaster() {
        return $this->site_master;
    } 
    
    function getAdminAvailable()
   {
       return $this->site_admin_available;
   }
   
   function getFrontendAvailable()
   {
       return $this->site_frontend_available;
   }
   
   function getAvailable()
   {
       return $this->site_available;
   }
   
   function isEqual(Site $site)
   {
       if ($site==null)
           return false;
       if ($site->getHost()==$this->getHost())
          return true;
       return false;
   }
   
   
   function getDirectory()
   {
      return mfConfig::get('mf_sites_dir')."/".$this->get('site_db_name');
   }
   
   function isSuperAdmin()
   {
       return (mfConfig::getSuperAdmin('site')==$this->getSiteName());
   }
   
   function __toString() {
       return $this->getHost();
   }
   
   function getThemeAdmin() {
        $theme=new ThemeCore($this->get('site_admin_theme'),'admin');
        $theme->loadTextI18nStatic();
        return $this->get('site_admin_theme');
   }

   function getThemeFrontEnd() {   
        $theme=new ThemeCore($this->get('site_frontend_theme'),'frontend');
        $theme->loadTextI18nStatic();
        return $this->get('site_frontend_theme');
   }
   
   function getThemeAdminBase() {
        $theme=new ThemeCore($this->get('site_admin_theme_base'),'admin');
        $theme->loadTextI18nStatic();
        return $this->get('site_admin_theme_base');
   }
   function hasThemeAdminBase()
   {
       return (boolean)!in_array($this->get('site_admin_theme_base'),array('','default'));
   }

   function getThemeFrontEndBase() {   
        $theme=new ThemeCore($this->get('site_frontend_theme_base'),'frontend');
        $theme->loadTextI18nStatic();
        return $this->get('site_frontend_theme_base');
   }
   
   function getThemeByApplication($application='frontend')
   {
       if ($application=='frontend')
       {
           return $this->get('site_frontend_theme');
       }    
       return $this->get('site_admin_theme');
   }
   
   function removeHostCache()
   {
       $this->removeFrontendHostCache();
       $this->removeAdminHostCache();
   }
   
   function removeFrontendHostCache()
   {
        $file = mfConfig::get('mf_cache_dir')."/frontend/hosts/".$this->get('site_host').".cache";      
        if (file_exists($file))
           unlink($file); // file_put_contents($file, "");
        return $this;
   }
   
   function removeAdminHostCache()
   {
        $file = mfConfig::get('mf_cache_dir')."/admin/hosts/".$this->get('site_host').".cache";      
        if (file_exists($file))
           unlink($file); // file_put_contents($file, "");
        return $this;
   }
   
   function clearCache()
   {
     mfFileSystem::net_rmdir(mfConfig::get('mf_cache_dir')."/sites/".$this->getHost()); 
     $this->removeHostCache();
   }
   
   function clearFrontendCache()
   {
     mfFileSystem::net_rmdir(mfConfig::get('mf_cache_dir')."/sites/".$this->getHost()."/frontend");
     $this->removeFrontendHostCache();
   }
   
    function clearAdminCache()
   {
     mfFileSystem::net_rmdir(mfConfig::get('mf_cache_dir')."/sites/".$this->getHost()."/admin");
     $this->removeAdminHostCache();
   }
   
   function isECommerce()
   {
       return ($this->get('site_type')=='ECOM');
   }
   
   function isCms()
   {
       return ($this->get('site_type')=='CMS');
   }
   
   function getHostName()
   {
       return str_replace("www.","",$this->getHost());
   }
   
   function getTheme($application='frontend')
   {
       if (!$this->_theme_id)
       {    
          $this->_theme_id=new Theme($this->getThemeByApplication($application),$application);
       }
       return $this->_theme_id;
   }         

   // http://stackoverflow.com/questions/5292937/php-function-to-get-the-subdomain-of-a-url
    function getSubdomains()
    {            
        if(preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $this->get('site_host'), $matches))   
            $domain=$matches['domain'];
         else
            $domain=$this->get('site_host');    
        return rtrim(strstr( $this->get('site_host'),$domain, true), '.');        
    }
    
    function isSubDomain()
    {
        return !in_array($this->getSubdomains(),array('','www'));        
    }
    
 /*   public function getDSize()
    {       
        $this->query="SELECT ROUND( SUM( data_length + index_length ) /1024 /1024, 2 ) AS size
                        FROM information_schema.TABLES
                        WHERE table_schema = '%s'
                        GROUP BY TABLE_SCHEMA;";
      
    }  */ 
     function hasLastConnection()
    {
       return  (boolean)$this->get('last_connection');
    }
    
    function getLastConnection()
    {
       return  format_date($this->get('last_connection'),array('d','q'));
    }
    
    static function getFtpDirectory($value="",$site=null)
    {
       return mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/ftp".$value; 
    }
    
    function getDomain()
    {
        return new mfDomain($this->get('site_host'));
    }
    
  
}