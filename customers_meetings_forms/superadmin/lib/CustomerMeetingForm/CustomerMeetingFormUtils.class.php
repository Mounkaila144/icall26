<?php

class CustomerMeetingFormUtils extends CustomerMeetingFormUtilsBase {
     
    
    
     static function update_0122($site=null)
    {        
          $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())                       
            ->setQuery("UPDATE  ".CustomerMeetingForm::getTable().                                         
                       " SET is_admin='Y' ".
                       " WHERE name LIKE 'free%%'".
                       ";")
            ->makeSiteSqlQuery($site);           
    }
    
}
