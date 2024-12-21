<?php


class CustomerBaseUtils {
            
    
    static function transferPhonesToMobile($site=null)
    {
         $db=mfSiteDatabase::getInstance()
            ->setParameters(array())
            ->setQuery("UPDATE ".Customer::getTable()." SET mobile=phone WHERE mobile='';")
            ->makeSiteSqlQuery($site);    
         
         return $db->getAffectedRows();        
    }        
    
    
}

