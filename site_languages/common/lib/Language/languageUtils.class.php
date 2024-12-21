<?php

class LanguageUtils { 
    
    
    static function getLanguages($application=null,$site=null)
    {
      //  $fileCache=self::getFileCache('languages.list',$application,$site);   
     //   if (is_readable($fileCache))
     //       return unserialize(self::readCacheFile($fileCache));
        
        $cache= new mfCacheFile('languages.list',$application,$site);
        if ($cache->isCached())       
            return unserialize($cache->read());       
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code FROM t_languages WHERE is_active='YES' AND application=@@APPLICATION@@ ORDER BY position ASC;")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($row=$db->fetchObject('language'))
        {             
            $languages[]=$row;
        }  
        $cache->register(serialize($languages));
        // registered cache
       // var_dump($application);      
     //   self::registerCache("languages.list",serialize($languages),$application,$site);
      //  register_shutdown_function('mfCacheFile::writeCacheFile','languages.list',serialize($languages),$application,$site);
        return $languages;
    }   
    
    static function cmpCountry($a,$b)
    {
       if ($a->get('country')==$b->get('country'))
           return 0;
       if ($a->get('country')<$b->get('country'))
           return -1;
       else
           return 1;
    }
    
    static function sortByCountry(&$languages)
    {
        foreach ($languages as $language)
               $language->country=format_country($language->get('code'));
        usort($languages,'languageUtils::cmpCountry');
    }
    
    static function sortByCountryToArray($languages)
    {
        $sortedLanguages=array();
        foreach ($languages as $language)
               $sortedLanguages[$language]=format_country($language);
        asort($sortedLanguages);
        return $sortedLanguages;
    }
    
    static function getFrontendLanguages($site=null)
    {
              
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code FROM t_languages WHERE is_active='YES' AND application='frontend' ORDER BY position ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($row=$db->fetchArray())
        {          
            $languages[$row['code']]=$row['code'];
        }               
        return $languages;
    }  
 }
 
 