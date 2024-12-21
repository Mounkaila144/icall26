<?php

class TextI18nBaseUtils  {
    
    static function getListTextI18N($class,$site=null)
    {
        $db=mfSiteDatabase::getInstance();
        $db->setParameters()
           ->setQuery("SELECT * FROM ".$class::getTable()." ORDER BY lang ASC;")
           ->makeSiteSqlQuery($site);                         
        if (!$db->getNumRows())
            return array(); 
        $items=array();
        while ($row=$db->fetchObject($class))
            $items[]=$row;   
        return $items;
    }   
    
    static function getLanguages($class,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT DISTINCT(lang) FROM ".$class::getTable()." ;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $languages=array();
        while ($language=$db->fetchArray())
        { 
            $languages[$language['lang']]=$language['lang'];
        }      
        return $languages;
    }
}
