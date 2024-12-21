<?php

class Site extends SiteBase {
        
   
    function getLinkedSites()
    {
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('db_name'=>$this->getSiteName()))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE site_db_name='{db_name}';")
                 ->makeSqlQuerySuperAdmin();   
        $sites=array();
        while ($item=$db->fetchObject('Site'))
        {
            $sites[]=$item->loaded();
        }               
        return $sites;
    }
       
}