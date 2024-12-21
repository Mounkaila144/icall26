<?php

class SiteUtils {
    
    static function exist($site)
    {
        return is_dir(mfConfig::get('mf_sites_dir')."/".$site);
    }
    
    static function getSites()
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters()
            ->setQuery("SELECT * FROM ".Site::getTable().";")
            ->makeSqlQuerySuperAdmin();
         if (!$db->getNumRows())
            return array();
        $sites=array();
        while ($item=$db->fetchObject('Site'))
        {
           $item->loaded();
           $sites[]=$item;
        }     
        return $sites;
    }
    
    static function getSitesGroupByDatabase()
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters()
            ->setQuery("SELECT * FROM ".Site::getTable()." GROUP BY site_db_name;")
            ->makeSqlQuerySuperAdmin();
         if (!$db->getNumRows())
            return array();
        $sites=array();
        while ($item=$db->fetchObject('Site'))
        {
           $item->loaded();
           $sites[]=$item;
        }     
        return $sites;
    }
    
    static function getListDatabase()
    {
        $databases=array();
        foreach (scandir(mfConfig::get('mf_sites_dir')) as $database)
        {
            if (in_array($database,array('themes','ftp','themings','.svn','.','..','.htaccess')))
               continue;
            $databases[$database]=$database;
                    
        }    
        return $databases;
    }
    
    static function createSiteDirectories(Site $site)
    {       
        $schema=array(
            "site"=>array(
                 "src"=>"site_skeleton",
                 "dst"=>mfConfig::get('mf_sites_dir')."/".$site->get('site_db_name')
            ),
            "tmp"=>array(
                 "src"=>"site_tmp_skeleton", 
                 "dst"=>mfConfig::get('mf_cache_dir')."/sites/".$site->get('site_host')
            )
        );
        
        foreach ($schema as $name=>$transfert) 
        {
           $src=mfContext::getInstance()->getConfiguration()->getModulePath('site')."/superadmin/data/".$transfert['src'];    
           $dst=$transfert['dst'];
           mfFilesystem::xcopy($src,$dst);
        }    
        
    }
    
    protected static function deleteSiteDirectories(Site $site)
    {
       $dirs=array(mfConfig::get('mf_sites_dir')."/".$site->get('site_db_name'),
                   mfConfig::get('mf_cache_dir')."/sites/".$site->get('site_host')
                   );
       mfFileSystem::net_rmdirs($dirs);
    }
  
    
     protected static function isHostsandMastersExists(Site $site)
     {
         $db = new mfSiteDatabase;
         $db->setParameters(array($site->get('site_db_name'),$site->get('site_db_name')))
            ->setQuery("SELECT count(site_id) FROM t_sites WHERE site_db_name='%s' OR site_master='%s';")
            ->makeSqlQuerySuperAdmin();
         $result = $db->fetchRow() ;
         return $result[0];
     }
     
     static function deleteSite(Site $site)
     {
        $site->set("site_available","NO");
        $site->save(); // Met le site OFF
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($site, 'site.change','delete'));
        // zip + site + database => rep ????
        // Check si il n'y a pas d'autres sites et master sur la database 
        if (self::isHostsandMastersExists($site)==1)
        {
          // Don't remove super admin db
          if (mfConfig::getSuperAdmin('site')!=$site->get('site_db_name'))
          {  
              try
              {
                 self::uninstallModules($site);
              }
              catch (Exception $e)
              {
                  
              }
             // Supprimer la database du server DROP ...
             $db = new mfSiteDatabase();
             $db->dropDatabase($site);
             // Supprimer le repertoire 
             self::deleteSiteDirectories($site);
             // Remove site on db
             $site->delete();
           //   mfContext::getInstance()->getSite()->clearHostCache($site); // Remove host cache 
          }   
        }       
     }
     
    static function createSite(Site $site)
    {
        
        try
        {
            // 1- Creation de la Database du site
            $db=mfSiteDatabase::getInstance()->createDatabase($site);
            // 2- Creation du squelette du site            
            self::createSiteDirectories($site);                                                        
            // 3- Reprendre tous les fichiers schema/data des modules          
            self::InstallModules($site);            
            //4 - site installation event for other install
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($site, 'site.create','new'));
        }
        catch (mfException $e)
        {
            self::deleteSite($site);            
            throw new mfException(__("Site Creation Error. [%s]",$e->getMessage()));
        } 
    }
    
    static function installModules(Site $site)
    {   
        $report=mfReport::getInstance('install/'.$site->get('site_host'));        
        foreach (mfContext::getInstance()->getConfiguration()->getModules() as $name)
        {          
           try
           { 
                self::installModule($name,$site);                
           }      
           catch (mfModuleException $e)
           {                
               $report->addMessage($e->getI18nMessage());            
           }
           catch (mfModuleInstallerException $e)
           {        
              if (!in_array($e->getCode(),array(
                  mfModuleInstallerException::ERROR_NO_CONFIG_FILE,
                  mfModuleInstallerException::ERROR_NOT_AUTHORIZED
              )))
              {        
                $report->addMessage($e->getI18nMessage());                    
              }
           }        
           catch (mfException $e)
           {
              $report->addMessage(sprintf("error %s ",$e->getMessage()));  
              $report->close();
              throw new mfException(sprintf("%s - module (%s)",$e->getMessage(),$name));  
           }        
        }
        $report->close();
    }
    
    static function uninstallModules(Site $site)
    {
        foreach (mfContext::getInstance()->getConfiguration()->getModules() as $name)
        {           
           try
           { 
               self::uninstallModule($name,$site);              
           }                       
           catch (mfException $e)
           {              
              throw new mfException(sprintf("%s - module (%s)",$e->getMessage(),$name));  
           }       
        }
    }
    
    static function installModule($name,Site $site)
    {       
        $module=new mfModule($name,$site);
        $module->setInstallerClass(class_exists('moduleUpdater')?"moduleUpdater":"moduleInstaller");
        $module->getInstaller()->setOption('mode','site');
        $module->getInstaller()->setLogReport(mfReport::getInstance('install/'.$site->get('site_host')));
        $module->getInstaller()->install();
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($module, 'module.installed')); // Installer 
    }
    
    static function uninstallModule($name,Site $site)
    {                     
        $module=new mfModule($name,$site);       
        $module->getInstaller()->uninstall();
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($module, 'module.uninstalled'));
    }
    
    static function getSitesBySites($sites_id)
    {
       $sites=new SiteCollection();
       $db=mfSiteDatabase::getInstance()
            ->setParameters()
            ->setQuery("SELECT * FROM ".Site::getTable().
                       " WHERE site_id IN('".implode("','",$sites_id)."');")
            ->makeSqlQuerySuperAdmin();
         if (!$db->getNumRows())
            return $sites;        
        while ($item=$db->fetchObject('Site'))
        {          
           $sites[]=$item->loaded();
        }     
        return $sites; 
    }
    
    
     static function getDatabases()
    {
        static $databases=null;
        
        if ($databases===null)
        {    
            $databases=new mfArray();
            $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT site_db_name FROM ".Site::getTable()." GROUP BY site_db_name;")
                ->makeSqlQuerySuperAdmin();
             if (!$db->getNumRows())
                return $databases;
            while ($row=$db->fetchArray())
            {
               $databases[]=$row['site_db_name'];
            }
        }
        return $databases;
    }
    
    
    static function getSiteCollection()
    {
        static $sites=null;
        
        if ($sites===null)
        {    
            $sites=new SiteCollection();
            $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".Site::getTable().";")
                ->makeSqlQuerySuperAdmin();
             if (!$db->getNumRows())
                return $sites;
            while ($item=$db->fetchObject('Site'))
            {
               $sites[$item->get('site_id')]=$item->loaded();
            }
            $sites->loaded();
        }      
        return $sites;
    }
    
    
    static function initializeSite(Site $site=null)
    {
         
       
    }
    
    
    static function getDatabasesExceptedForSelect(Site $site)
    {
        static $databases=null;
        
        if ($databases===null)
        {    
            $databases=new mfArray();
            if ($site->isNotLoaded())
                return $databases;
            $db=mfSiteDatabase::getInstance()
                ->setParameters(array('site_id'=>$site->get('site_id')))
                ->setQuery("SELECT site_id,site_db_name FROM ".Site::getTable().
                           " WHERE site_id!='{site_id}'".                          
                           " GROUP BY site_db_name".
                           " ORDER BY site_db_name ASC ".
                           ";")
                ->makeSqlQuerySuperAdmin();
             if (!$db->getNumRows())
                return $databases;
            while ($row=$db->fetchArray())
            {
               $databases[$row['site_id']]=$row['site_db_name'];
            }
        }
        return $databases;
    }
    
    static function getSitesByHost($where="")
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters()
            ->setQuery("SELECT * FROM ".Site::getTable().
                       ($where?" WHERE ".$where:"").
                       ";")
            ->makeSqlQuerySuperAdmin();
         if (!$db->getNumRows())
            return array();
        $sites=array();
        while ($item=$db->fetchObject('Site'))
        {
           $item->loaded();
           $sites[]=$item;
        }     
        return $sites;
    }
}
