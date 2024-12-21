<?php

class CustomerCommentUtils extends CustomerCommentUtilsBase 
{
     static function initializeSite($site=null)
    {
           $db=mfSiteDatabase::getInstance()                         
                ->setQuery("DELETE FROM ".CustomerComment::getTable().";")               
                ->makeSiteSqlQuery($site); 
           
           $db->setQuery("ALTER TABLE  ".CustomerComment::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
                      
           $db->setQuery("DELETE FROM ".CustomerCommentHistory::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("ALTER TABLE  ".CustomerCommentHistory::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
    }
}
