<?php


class sitesAdmin {
    
    static function getlistSites()
    {
        static $sites=array();
          if ($sites)
            return $sites;
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT * FROM ".Site::getTable().                             
                             ";")
                  ->makeSqlQuerySuperAdmin();
           if (!$db->getNumRows()) return null;
           while ($row = $db->fetchObject("Site")) {
               $sites[]=$row;
           }
         return $sites;                   
    }
    
    static function getlistSitesByName()
    {
        static $sites=array();
          if ($sites)
            return $sites;
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT * FROM ".Site::getTable(). 
                          //   " WHERE site_db_name IN('site_iso6b','ecosol_project1')".   // 'site_iso6b','ecosol_project1'
                             " GROUP BY site_db_name".
                             ";")
                  ->makeSqlQuerySuperAdmin();
           if (!$db->getNumRows()) return null;
           while ($row = $db->fetchObject("Site")) {
               $sites[$row->get('site_id')]=$row->loaded();
           }
         return $sites;                   
    }
    
    static function getCompaniesForSelect()
    {    
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT * FROM ".Site::getTable().
                             " WHERE site_company!=''".
                             " GROUP BY site_company".
                             ";")
                  ->makeSqlQuerySuperAdmin();
           if (!$db->getNumRows()) return array();
           $list=array();
           while ($item = $db->fetchObject("Site")) {
               $list[$item->get('site_company')]=$item->get('site_company');
           }          
         return $list;                   
    }
    
    
    static function getSitesByHostForSelect()
    {
        $sites=array();         
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT * FROM ".Site::getTable()." ORDER BY site_host ASC;")
                  ->makeSqlQuerySuperAdmin();
           if (!$db->getNumRows()) return $sites;
           while ($item = $db->fetchObject("Site")) {
               $sites[$item->get('site_id')]=$item->get('site_host');
           }
         return $sites;                   
    }
    
    
    static function getlistSiteName()
    {
        static $sites=array();
          if ($sites)
            return $sites;
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT *  FROM ".Site::getTable()." GROUP BY site_db_name;")
                  ->makeSqlQuerySuperAdmin();
           if (!$db->getNumRows()) return null;
           while ($item = $db->fetchObject("Site")) {
               $sites[$item->get('site_id')]=$item->loaded();
           }
         return $sites;                   
    }
    
    static function getlistSitesByHost()
    {
        static $sites=array();
        if ($sites)
            return $sites;
        $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT site_host FROM t_sites;")
                  ->makeSqlQuerySuperAdmin();
        if (!$db->getNumRows()) return null;
        $sites=array();
        while ($row = $db->fetchArray()) {
             $sites[]=$row['site_host'];
        }
        return $sites;                   
    }
    
    static function disableGlobalSites()
    {
       $db=mfSiteDatabase::getInstance()
                  ->setQuery("UPDATE t_sites SET site_available='NO' WHERE site_available='YES';")
                  ->makeSqlQuerySuperAdmin(); 
       mfContext::getInstance()->getSite()->deleteAllCacheHost();
    }
    
    static function getListActiveSitesByName()
    {
        static $sites=array();
          if ($sites)
            return $sites;
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT * FROM ".Site::getTable(). 
                             " WHERE  site_available='YES'".
                             " GROUP BY site_db_name".
                             ";")
                  ->makeSqlQuerySuperAdmin();
           if (!$db->getNumRows()) return null;
           while ($item = $db->fetchObject("Site")) {
               $sites[]=$item->loaded();
           }
         return $sites;                   
    }
    
     static function getlistSitesByNameWhereModuleIsInstalled($module)
    {
        static $sites=array();
        if(empty($module))
            return $sites;
       
        if ($sites)
            return $sites;
       
        $db=mfSiteDatabase::getInstance()
            ->setQuery("SELECT * FROM ".Site::getTable().
                       " GROUP BY site_db_name".
                       ";")
            ->makeSqlQuerySuperAdmin();
        if (!$db->getNumRows()) return null;
        while ($item = $db->fetchObject("Site")) {
            if(!mfModule::isModuleInstalled($module,$item->loaded()))
               continue;
            $sites[$item->get('site_id')]=$item;
        }
        return $sites;                  
    }
    
    
    static function getListSitesInThemesByName(mfArray $themes)
    {
        static $sites=array();
          if ($sites)
            return $sites;
          $db=mfSiteDatabase::getInstance()
                  ->setQuery("SELECT * FROM ".Site::getTable(). 
                             " WHERE  site_admin_theme IN('".$themes->implode("','")."')".
                             " GROUP BY site_db_name".
                             ";")
                  ->makeSqlQuerySuperAdmin();
           if (!$db->getNumRows()) return null;
           while ($item = $db->fetchObject("Site")) {
               $sites[]=$item->loaded();
           }
         return $sites;                   
    }
    
        
}

