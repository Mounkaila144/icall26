<?php


class SiteCompanyUtils {
    
    
   static function getSiteCompany($site=null)
   {
       static $company=array();
       $_site=($site instanceof Site)?$site->get('site_db_name'):$site;       
       if (isset($company[$_site]))
          return $company[$_site];
       $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".SiteCompany::getTable().";")               
                ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
        {
            $company[$_site]=new SiteCompany(null,$site);
            return $company[$_site];
        }    
        $company[$_site]=$db->fetchObject('SiteCompany')->loaded();      
        $company[$_site]->site=$site;       
        return $company[$_site];
   }
   
   static function isSiteCompanyExist($site=null)
   {
      return self::getSiteCompany($site);
   }
   
 /*  static function getListCompany($site=null)
   {
        static $companies=array();
        $_site=($site instanceof Site)?$site->get('site_db_name'):$site;     
        if (isset($companies[$_site]))
           return $companies[$_site];
        $companies[$_site]=array();
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM t_company;")               
                ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
         return $companies[$_site];
        $companies[$_site]=array();
        while ($row=$db->fetchObject('company'))
        {
            $companies[$_site][]=$row;
        }     
        return $companies[$_site];
   }
   
    static function getAvailableCompanyIds($site=null)
    {
        static $companies=array();
        $_site=($site instanceof Site)?$site->get('site_db_name'):$site;     
        if (isset($companies[$_site]))
           return $companies[$_site];
        $companies[$_site]=array();
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT id FROM t_company;")               
                ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        while ($row=$db->fetchArray())
        {
            $companies[$_site][]=$row['id'];
        }     
        return $companies[$_site]; 
    }*/
   
}

