<?php


class PartnerUtilsBase {
  
    
    static function getPartnerForSelect($site=null)
    {
        static $list=null;
        if ($list) return $list;
        $cache= new mfCacheFile('contract_financial_partner.select','admin',$site);
        if ($cache->isCached())       
            return $list=unserialize($cache->read());   
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Partner::getTable().
                           " WHERE is_active='YES'".
                           " ORDER BY name COLLATE UTF8_GENERAL_CI ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
         {
             $cache->register(serialize(array()));
            return $list=array();
        }       
        while ($item=$db->fetchObject('Partner'))
        {
           $list[$item->get('id')]="test";
        }     
        $cache->register(serialize($list));
        return $list;
    }   
    
     static function getPartnersForSelect($site=null)
    {
        $cache= new mfCacheFile('contract_financial_partner.select2','admin',$site);
        if ($cache->isCached())       
            return unserialize($cache->read());  
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Partner::getTable().                         
                           " ORDER BY name COLLATE UTF8_GENERAL_CI ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())       
         {
             $cache->register(serialize(array()));
            return array();
        }
        $list=array();
        while ($item=$db->fetchObject('Partner'))
        {
           if ($item->get('id'))
               $item->loaded();           
           $list[$item->get('id')]= $item;
        }     
        $cache->register(serialize($list));
        return $list;
    }   
    
    
     static function initializeSite($site=null)
    {      
         $db=mfSiteDatabase::getInstance()                            
                ->setQuery("DELETE FROM ".Partner::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("ALTER TABLE  ".Partner::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
            
         $db->setQuery("DELETE FROM ".PartnerContact::getTable().";")               
                ->makeSiteSqlQuery($site);         
         $db->setQuery("ALTER TABLE  ".PartnerContact::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
         
         $db->setQuery("DELETE FROM ". PartnerFile::getTable().";")               
                    ->makeSiteSqlQuery($site);  
         $db->setQuery("ALTER TABLE  ".PartnerFile::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
         mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/view/data/partners/files"); 
        /*  $db->setQuery("TRUNCATE ".CustomerMeetingProduct::getTable().";")               
                ->makeSiteSqlQuery($site); 
          $db->setQuery("TRUNCATE ".CustomerMeeting::getTable().";")               
                ->makeSiteSqlQuery($site); */
    }
   
}

