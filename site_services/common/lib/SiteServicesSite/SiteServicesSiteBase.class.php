<?php


class SiteServicesSiteBase extends mfObject2 {

    
    protected static $fields=array('host','db_name' ,'db_login' ,'db_password','db_host' ,'admin_theme',
                                    'admin_theme_base','admin_available' ,'frontend_theme' ,'frontend_theme_base',
                                    'frontend_available','available','type','logo','picture','master','access_restricted',
                                    'is_customer','company' ,'is_uptodate','banner' ,'server_id','favicon',
                                    'last_connection','price','description','status','is_active',
                                    'db_size','size'
                                  );
    const key="id",table="t_site_services_site";
    protected static  $foreignKeys=array('server_id'=>'SiteServicesServer');
    protected static $fieldsNull=array('last_connection');
    
    function __construct($parameters=null)
    {    
      $this->getDefaults();
      if ($parameters===null)  return $this;
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      { // PRIMARY KEY
         if (isset($parameters['id']))
             return  $this->loadbyId((string)$parameters['id']); 
         if (isset($parameters['host']))
             return  $this->loadbyHost((string)$parameters['host']); 
         if (isset($parameters['db_name']) && isset($parameters['server']) && $parameters['server'] instanceof SiteServicesServer)
             return  $this->loadbyNameAndServer($parameters['db_name'],$parameters['server']);
          if (isset($parameters['host']) && isset($parameters['server']) && $parameters['server'] instanceof SiteServicesServer)
             return  $this->loadbyHostAndServer($parameters['host'],$parameters['server']);
         if (isset($parameters['db_name']))
             return  $this->loadbyName((string)$parameters['db_name']);
         return $this->add($parameters); 
      }   
      else
      {
        if (is_numeric((string)$parameters))
           return $this->loadbyId((string)$parameters);  
        return $this->loadbyHost((string)$parameters);
      }  
    } 
    
     protected function loadbyNameAndServer($name,SiteServicesServer $server) {
         $this->set('name',$name);
         $this->set('server_id',$server);
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('name'=>$name,'server_id'=>$server->get('id')))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE db_name='{name}' AND server_id='{server_id}' LIMIT 1;")
                 ->makeSqlQuerySuperAdmin();   
        return  $this->rowtoObject($db);
    }
    
      protected function loadbyHostAndServer($host,SiteServicesServer $server) {
         $this->set('host',$host);
         $this->set('server_id',$server);
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('host'=>$host,'server_id'=>$server->get('id')))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE host='{host}' AND server_id='{server_id}' LIMIT 1;")
                 ->makeSqlQuerySuperAdmin();   
        return  $this->rowtoObject($db);
    }
    
    protected function loadbyHost($host) {
        $this->set('host',$host);
        $db=mfSiteDatabase::getInstance();       
        $db->setParameters(array($host))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE host='%s' LIMIT 1;")
                 ->makeSqlQuerySuperAdmin();   
        return  $this->rowtoObject($db);
    }
    
     protected function loadbyName($name) {
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array($name))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE db_name='%s' LIMIT 1;")
                 ->makeSqlQuerySuperAdmin();   
        return  $this->rowtoObject($db);
    }
    
     protected function executeLoadById($db) 
     {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d LIMIT 1;")
           ->makeSqlQuerySuperAdmin();  
     }
         
      
    protected function getDefaults()
    {
       $this->admin_available=isset($this->admin_available)?$this->admin_available:"NO";
       $this->frontend_available=isset($this->frontend_available)?$this->frontend_available:"NO";
       $this->admin_theme=isset($this->admin_theme)?$this->admin_theme:"default";
       $this->admin_theme_base=isset($this->admin_theme_base)?$this->admin_theme_base:"default";
       $this->type=isset($this->type)?$this->type:"CUST";
       $this->frontend_theme=isset($this->frontend_theme)?$this->frontend_theme:"default";
       $this->frontend_theme_base=isset($this->frontend_theme_base)?$this->frontend_theme_base:"default";
       $this->available=isset($this->available)?$this->available:"NO";
       $this->is_customer=isset($this->is_customer)?$this->is_customer:"YES";
       $this->price=isset($this->price)?$this->price:0;
       $this->last_connection=isset($this->last_connection)?$this->last_connection: null;
       $this->access_restricted=isset($this->access_restricted)?$this->access_restricted: 0;
       $this->is_uptodate=isset($this->is_uptodate)?$this->is_uptodate:"NO";
       $this->status=isset($this->status)?$this->status:"ACTIVE"; 
       $this->is_active=isset($this->is_active)?$this->is_active:"Y"; 
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
                ->setQuery("SELECT id FROM ".self::getTable()." WHERE host='%s';")
                ->makeSqlQuerySuperAdmin();
    }

    /* ********************************************************************************************** */
    function getHost()
    {
        return $this->host;
    }
    
    function hasLastConnection()
    {
       return  (boolean)$this->get('last_connection');
    }

    function getSiteName() {
        return $this->db_name;
    }

    function getType() {
        return $this->type;
    }

    function getAdminAvailable()
   {
       return $this->admin_available;
   }
   
   function getFrontendAvailable()
   {
       return $this->frontend_available;
   }
   
   function getAvailable()
   {
       return $this->available;
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
      return mfConfig::get('mf_sites_dir')."/".$this->get('db_name');
   }
   
   function isSuperAdmin()
   {
       return (mfConfig::getSuperAdmin('site')==$this->getSiteName());
   }
   
   function __toString() {
       return $this->getHost();
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
   
   function getServer()
   {
       if($this->_server_id===null){
           
           $this->_server_id=new SiteServicesServer($this->server_id);
       }
       return $this->_server_id;
   }
   
    
     function transferArraySite($array_site){   
        foreach($array_site as $field=>$value)
       {
           if ($field=='site_id')
               continue;
           $this->set(str_replace('site_', '', $field),$value);  
       }
       return $this;
   }
       
    function getThemeAdmin() {
        $theme=new ThemeCore($this->get('admin_theme'),'admin');
        $theme->loadTextI18nStatic();
        return $this->get('admin_theme');
   }
  
   
   function getThemeAdminBase() {
        $theme=new ThemeCore($this->get('admin_theme_base'),'admin');
        $theme->loadTextI18nStatic();
        return $this->get('admin_theme_base');
   }
   function hasThemeAdminBase()
   {
       return (boolean)!in_array($this->get('admin_theme_base'),array('','default'));
   }
   
   static function getSitesForChoices()
   {
       $list=new mfArray();
        $db = mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT id FROM ".self::getTable().";")
               ->makeSqlQuerySuperAdmin();
        if (!$db->getNumRows())
                     return $list;
             while ($row=$db->fetchArray())
             {            
                  $list[]=$row['id'];
             } 
             return $list;
   }
   
   function toArray()
   {
       return parent::toArray(array('host','db_name' ,'admin_theme',
                                    'admin_theme_base','admin_available' ,'frontend_theme' ,
                                    'frontend_available','available','type','logo','picture',    
                                 //   'company', 'description',
                                   ));
   }
   
    function toArrayForCreate()
   {
       return parent::toArray(array('host','db_name' ,'admin_theme',
                                    'admin_theme_base','admin_available' ,'frontend_theme' ,
                                    'frontend_available','available','type','logo','picture',    
                                    'company', 'description',
                                   ));
   }
   
   function getDomain()
    {
        return new mfDomain($this->get('host'));
    }
    
    function getSiteSize()
    {
        return format_size($this->get('size'));
    }
    
      function getDatabaseSize()
    {
        return format_size($this->get('db_size'));
    }

}
