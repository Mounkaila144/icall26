<?php

class ThemeUtils {
    
   static function getThemes($application,$site=null)
   {
       $db=mfSiteDatabase::getInstance()          
           ->setQuery("SELECT * FROM ".Theme::getTable()." WHERE application='{application}';")               
           ->makeSqlQuery($application,$site);      
        if (!$db->getNumRows())
          return array();
        $themes=array();
        while ($theme=$db->fetchObject('Theme'))
        {
            $themes[]=$theme;
        }               
        return $themes;
   }        
   
   static function getFrontendThemesByName($site=null)
   {
       $db=mfSiteDatabase::getInstance()          
           ->setQuery("SELECT * FROM ".Theme::getTable()." WHERE application='frontend';")               
           ->makeSiteSqlQuery($site);      
        if (!$db->getNumRows())
          return array();
        $themes=new ThemeFrontendCollection(null,$site);
        while ($theme=$db->fetchObject('ThemeFrontend'))
        {
            $themes[$theme->get('name')]=$theme;
        }               
        return $themes;
   }     
}

