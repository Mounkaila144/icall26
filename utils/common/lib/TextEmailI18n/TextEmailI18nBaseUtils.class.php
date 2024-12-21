<?php

class TextEmailI18nBaseUtils  {
    
  /*  static function getListTextI18N($module,$site=null)
    {
        $db=mfSiteDatabase::getInstance();
        $db->setParameters(array('module'=>$module))
           ->setQuery("SELECT * FROM ".TextEmailI18n::getTable()." WHERE module='{module}' ORDER BY lang ASC;")
           ->makeSiteSqlQuery($site);                         
        if (!$db->getNumRows())
            return array(); 
        $items=array();
        while ($row=$db->fetchObject('TextEmailI18n'))
            $items[]=$row;   
        return $items;
    }  */ 
    
    static function getLanguages($module,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('module'=>$module))
                ->setQuery("SELECT DISTINCT(lang) FROM ".TextEmailI18n::getTable()." WHERE module='{module}';")               
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
