<?php

class languageUtilsAdmin  {

       
    static function getLanguages($application=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".language::getTable()." WHERE application=@@APPLICATION@@;")               
                ->makeSqlQuery($application); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($language=$db->fetchObject('language'))
        { 
            $languages[$language->get('code')]=$language;
        }            
        return $languages;
    }
    
    static function getPositionLanguages($application=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".language::getTable()." WHERE application=@@APPLICATION@@ ORDER BY position ASC;")               
                ->makeSqlQuery($application); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($language=$db->fetchObject('language'))
        { 
            $languages[$language->get('code')]=$language;
        }            
        return $languages;
    }
    
      static function getLanguagesByCodeandApplication($application=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code FROM t_languages WHERE application=@@APPLICATION@@;")               
                ->makeSqlQuery($application); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($language=$db->fetchArray())
        { 
            $languages[]=$language['code'];
        }            
        return $languages;
    }
    
     static function getI18nLanguagesFrontend()
    {
        static $cache=null;
               
        if ($cache)
            return $cache;
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code,is_active FROM t_languages WHERE application='frontend';")               
                ->makeSiteSqlQuery(); 
        if (!$db->getNumRows())
            return null;
        $languages=new languageCollection();
        
        while ($language=$db->fetchObject('language'))
        {           
            $languages[]=$language;
        }  
        $languages->sortByCountry();
        $cache=$languages;
        return $languages;
    }
 }