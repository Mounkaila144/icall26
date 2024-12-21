<?php

class SiteServicesServerBase extends mfObject2 {

    
    protected static $fields=array('host','name','ip','login_service','password',
                                    'is_active','is_inprogress','is_processed'
                                  );
    const table="t_site_services_server";
    
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
         if (isset($parameters['name']))
             return  $this->loadbyName((string)$parameters['name']);
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
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s' LIMIT 1;")
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
        $this->is_active= isset($this->is_active)?$this->is_active:'YES';
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

    static function getServers(){
        $list=new mfArray();
        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ". SiteServicesServer::getFieldsAndKeyWithTable()." FROM ".SiteServicesServer::getTable().
                           " ORDER BY host ASC;")               
                ->makeSqlQuerySuperAdmin(); 
        if (!$db->getNumRows())
            return $list;
        while ($item=$db->fetchObject('SiteServicesServer'))
        { 
            $list[$item->get('id')]=$item->loaded();
        }      
        return $list;
    }
    
     static function getActiveServers(){
        $list=new mfArray();
        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ". SiteServicesServer::getFieldsAndKeyWithTable()." FROM ".SiteServicesServer::getTable().
                           " WHERE is_active='YES'".
                           " ORDER BY host ASC;")               
                ->makeSqlQuerySuperAdmin(); 
        if (!$db->getNumRows())
            return $list;
        while ($item=$db->fetchObject('SiteServicesServer'))
        { 
            $list[$item->get('id')]=$item->loaded();
        }      
        return $list;
    }
    
    static function getServersForSelect(){
        $list=new mfArray();
        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ". SiteServicesServer::getTableFields(array('id','name'))." FROM ".SiteServicesServer::getTable().
                           " ORDER BY host ASC;")               
                ->makeSqlQuerySuperAdmin(); 
        if (!$db->getNumRows())
            return $list;
        while ($row=$db->fetchArray())
        { 
            $list[$row['id']]=$row['name'];
        }      
        return $list;
    }
    
     protected function loadSitesByHost()
   {
       $collection= new SiteServicesSiteCollection();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("SELECT * FROM ".SiteServicesSite::getTable().                          
                           ";") 
                ->makeSqlQuerySuperAdmin();   
        if (!$db->getNumRows())
            return $collection;
         while ($item=$db->fetchObject('SiteServicesSite'))         
         {
            $collection[$item->get('server_id')."-".$item->get('host')]=$item->loaded();
         }             
         $collection->loaded();
       return $collection;
   }
   
  
 
   function getSites(){
        
        $list=array();

        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('SiteServicesSite','SiteServicesServer'))
                ->setQuery("SELECT {fields} FROM ".SiteServicesSite::getTable().
                           " INNER JOIN ".SiteServicesSite::getOuterForJoin('server_id').
                           " ORDER BY ".SiteServicesSite::getTableField('host')." ASC;")               
                ->makeSqlQuerySuperAdmin();   
        if (!$db->getNumRows())
            return $list;
        while ($items=$db->fetchObjects())
        {        
            $item=$items->getSiteServicesSite();
            $item->set('server',$items->getSiteServicesServer());
            $list[$item->get('id')]=$item;
        }      
        return $list;
    }
      
    function  refresh()
    {
        $sites_collection= new SiteServicesSiteCollection();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('server_id'=>$this->get('id')))                
                ->setQuery("SELECT * FROM ".SiteServicesSite::getTable()." WHERE server_id='{server_id}'"                          .
                           ";") 
                ->makeSqlQuerySuperAdmin();   
        if ($db->getNumRows())
        {
            while ($item=$db->fetchObject('SiteServicesSite'))         
            {
               $sites_collection[$item->get('server_id')."-".$item->get('host')]=$item->loaded();
            }             
            $sites_collection->loaded();
        }
        
        $api=new iCall26ServerServiceApi($this);
        $api->login($this->get('login_service'),$this->getDecryptedPassword());    
 
        $sites=$api->siteList();  
 
        if (isset($sites['items']))
        {    
            foreach ($sites['items'] as $array_site)
            {              
               if ($sites_collection->hasItemByKey($this->get('id')."-".$array_site['site_host'])) 
               {                                 
                   $item=$sites_collection->getItemByKey($this->get('id')."-".$array_site['site_host']);
               }    
               else
               {                    
                $item=new SiteServicesSite();           
                $item->set('server_id',$this); 
               }
               $item->transferArraySite($array_site);
               //echo "<pre>"; var_dump($item->get('host')); echo "</pre>";
               $item->set('is_active','Y');
               $sites_collection[$this->get('id')."-".$item->get('host')]=$item;
            }         
        }  
        
          $sites_collection->save();        
        return $this;
    }
    
   function process(){
     
        $sites=new mfArray();  
        $this->updateIsActive();
        $sites_collection=$this->loadSitesByHost();
       
         
        foreach (SiteServicesServer::getActiveServers() as $server){
            
            $api=new iCall26ServerServiceApi($server);
            $api->login($server->get('login_service'),$server->getDecryptedPassword());    
            $sites=$api->siteList();  
            if (isset($sites['items']))
            {    
                foreach ($sites['items'] as $array_site)
                {              
                   if ($sites_collection->hasItemByKey($server->get('id')."-".$array_site['site_host'])) 
                   {                                 
                       $item=$sites_collection->getItemByKey($server->get('id')."-".$array_site['site_host']);
                   }    
                   else
                   {                    
                    $item=new SiteServicesSite();           
                    $item->set('server_id',$server); 
                   }
                   $item->transferArraySite($array_site);
                   //echo "<pre>"; var_dump($item->get('host')); echo "</pre>";
                   $item->set('is_active','Y');
                   $sites_collection[$server->get('id')."-".$item->get('host')]=$item;
                }         
            }
        } 
       
     //   echo "<pre>"; var_dump($sites_collection); echo "</pre>";
         $sites_collection->save();        
      //  return array("status"=>"OK","items"=> $this->getSites());
                    
     //  die(__METHOD__);
       return $this;
   }

     static function getServersForChoices()
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
   
   function setHost($host)
   {
       return $this->set('host',$host);
   }
   
   static function getActiveServersExcepted(mfArray $servers){
        $list=new mfArray();        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ". SiteServicesServer::getFieldsAndKeyWithTable()." FROM ".SiteServicesServer::getTable().
                           " WHERE is_active='YES' AND id NOT IN('".$servers->implode("','")."')".
                           " ORDER BY host ASC;")               
                ->makeSqlQuerySuperAdmin(); 
        if (!$db->getNumRows())
            return $list;
        while ($item=$db->fetchObject('SiteServicesServer'))
        { 
            $list[$item->get('id')]=$item->loaded();
        }      
        return $list;
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new SiteServicesSettings():$this->settings;
    }
    
    function getDecryptedPassword()
    {
         $ssl=new OpenCypherIVSSL($this->getSettings()->getPrivateKey());
         return $ssl->decrypt($this->get('password'),"ewebsolutionskech#2020");
    }
    
    
     protected function updateIsActive()
   {        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("UPDATE ".SiteServicesSite::getTable().                          
                         " SET " . SiteServicesSite::getTableField('is_active') ."='N' ;")
                ->makeSqlQuerySuperAdmin();    
        
        return $this;
   }
}
