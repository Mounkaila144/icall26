<?php


class PartnerPolluterUtils {
    
    
     static function initializeSite($site=null)
    {
         $db=mfSiteDatabase::getInstance()                   
                ->setQuery("DELETE FROM ".PartnerPolluterCompany::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("ALTER TABLE  ".PartnerPolluterCompany::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
           
           $db->setQuery("DELETE FROM ".PartnerPolluterContact::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("ALTER TABLE  ".PartnerPolluterContact::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
                   
    }
}
