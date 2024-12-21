<?php


class PartnerlayerUtils {
    
     static function initializeSite($site=null)
    {
         $db=mfSiteDatabase::getInstance()                   
                ->setQuery("DELETE FROM ".PartnerLayerCompany::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("ALTER TABLE  ".PartnerLayerCompany::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
           
           $db->setQuery("DELETE FROM ".PartnerLayerContact::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("ALTER TABLE  ".PartnerLayerContact::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
                   
    }
    
}
