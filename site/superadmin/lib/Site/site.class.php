<?php

class Site extends SiteBase {
      
    function getSiteID()
    {
       return str_replace(".","-",$this->getHost());
    }
    
    function getSiteKey()
    {
       return ucfirst(str_replace(array("www",".","-"),array(""),$this->getHost()));
    }
    
    function clearAutoload()
    {                 
         if ($this->isNotLoaded())
             return;         
          $dir = mfConfig::get('mf_cache_dir')."/*/*/config";         
          foreach (glob($dir."/config_autoload.php") as $file)
              unlink($file);
    }
    
    function clearDatabases()
    {          
         if ($this->isNotLoaded())
             return;
          $dir = mfConfig::get('mf_cache_dir')."/databases";
          mfFileSystem::net_rmdir($dir);
    }
    
    function clearHostCacheFrontend()
    {          
         if ($this->isNotLoaded())
             return;
          $file = mfConfig::get('mf_cache_dir')."/frontend/hosts/".$this->get('site_host').".cache";
          if (file_exists($file))              
              unlink($file);  
    }
     
    function clearHostCacheAdmin()
    {        
        if ($this->isNotLoaded())
            return;
         $file = mfConfig::get('mf_cache_dir')."/admin/hosts/".$this->get('site_host').".cache";
         if (file_exists($file))
             unlink($file);  
    }
     
    function clearHostCache()  
    {
       $this->clearHostCacheAdmin();
       $this->clearHostCacheFrontend();
    } 
    
     protected function getConfigFile()
   {
      if (!$this->hasConfigFile())
          return null;
      $xml=simplexml_load_file($this->getDirectory()."/config.xml");     
      if (!$xml)
         return null;
      return $xml;
   }
   
   function hasConfigFile()
   {
       return is_readable($this->getDirectory()."/config.xml");
   }
   
   function loadConfigFile()
   {
      if (($xml=$this->getConfigFile()))
      {
          $this->set('site_type',$xml->type);
          $this->set('source',$xml->source);
          $this->set('site_admin_theme',$xml->admin_theme);
          $this->set('site_admin_theme_base',$xml->admin_theme_base);
          $this->set('site_frontend_theme',$xml->frontend_theme);             
          return true;
      }              
      return false;
   }
     
  /*   function setDatabaseParameters()
    {
      //  $settings= SoapOvhSettings::load();
      //  $this->set('site_db_name',$settings->get('root_db_name').sprintf("%4.4s%02d",$this->getSubdomains(),$this->getNextId()));
        $this->set('site_db_password',mfTools::generatePassword());
        return $this;
    }*/
    
    function getFolderSize()
    {
        return mfFileSystem::foldersize($this->getDirectory());
    }
    
    function getDatabaseSizeFromServer()
    {        
         $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('database'=>$this->get('site_db_name')))
                 ->setQuery("SELECT  sum((data_length + index_length))  as `size` ".
                            " FROM information_schema.TABLES ".
                            " WHERE table_schema = '{database}'".
                            ";")
                  ->makeSqlQuerySuperAdmin();
         $row=$db->fetchArray();
        return $row['size'];
    }
    
    function isDatabaseExist()
    {
         return mfSiteDatabase::getInstance()->isDatabaseExist($this);
    }
    
    function getDatabaseServer()
    {
        return new SystemMySqlServer($this->get('site_db_host'),$this->get('site_db_login'),$this->get('site_db_password'));
    }
}