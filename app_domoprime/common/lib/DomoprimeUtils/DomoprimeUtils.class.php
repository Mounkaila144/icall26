<?php

class DomoprimeUtils  {
     
   
     static function initializeSite($form)
    {         
         $site=$form->getSite();         
         if ($form->getValue('app_domoprime_clean'))
         {                 
            $db=mfSiteDatabase::getInstance()                           
                   ->setQuery("DELETE FROM ".DomoprimeBilling::getTable().";")               
                   ->makeSiteSqlQuery($site); 
            $db->setQuery("ALTER TABLE  ".DomoprimeBilling::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
               
            $db->setQuery("DELETE FROM ".DomoprimeCalculation::getTable().";")               
                   ->makeSiteSqlQuery($site);  
            $db->setQuery("ALTER TABLE  ".DomoprimeCalculation::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
            
            $db->setQuery("DELETE FROM ".DomoprimeQuotation::getTable().";")               
                   ->makeSiteSqlQuery($site);   
            $db->setQuery("ALTER TABLE  ".DomoprimeQuotation::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
            
             $db->setQuery("DELETE FROM ".DomoprimeAsset::getTable().";")               
                   ->makeSiteSqlQuery($site);   
            $db->setQuery("ALTER TABLE  ".DomoprimeAsset::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site);                                     
            mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/data/domoprime");         
         }
         if ($form->getValue('app_domoprime_polluters_clean'))
         {                
            $db=mfSiteDatabase::getInstance()
                   ->setQuery("DELETE FROM ".DomoprimePollutingCompany::getTable().";")               
                   ->makeSiteSqlQuery($site);     
             $db->setQuery("ALTER TABLE  ".DomoprimePollutingCompany::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
             
             $db->setQuery("DELETE FROM ".DomoprimePollutingContact::getTable().";")               
                   ->makeSiteSqlQuery($site);     
              $db->setQuery("ALTER TABLE  ".DomoprimePollutingContact::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
             mfFileSystem::net_rmdir(mfConfig::get('mf_sites_dir')."/".$site->getSiteName()."/frontend/data/models/documents/polluters"); 
         }
    }
    
   
}
