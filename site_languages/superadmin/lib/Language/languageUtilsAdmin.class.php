<?php

class languageUtilsAdmin  {

    static function getLanguagesAllowed()
    {
        $languages=array();
        foreach (mfCountryInfo::getCountries() as $language)
           $languages[]=strtolower($language); 
        return $languages;// array("at","be","ch","de","dk","ee","en","es","fi","fr","gr","hr","hu","ie","it","li","lt","lu","mt","nl","no","pl","pt","ro","se","si");
    }    
    
    static function getLanguages($application=null,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".language::getTable()." WHERE application=@@APPLICATION@@;")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($language=$db->fetchObject('language'))
        { 
            $languages[$language->get('code')]=$language;
        }            
        return $languages;
    }
    
    static function getPositionLanguages($application=null,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".language::getTable()." WHERE application=@@APPLICATION@@ ORDER BY position ASC;")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($language=$db->fetchObject('language'))
        { 
            $languages[$language->get('code')]=$language;
        }            
        return $languages;
    }
    
 /*   static function getFrontendLanguagesByCode($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code FROM t_languages WHERE application='frontend';")               
                ->makeSqlQuery(null,$site); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($language=$db->fetchArray())
        { 
            $languages[]=$language['code'];
        }            
        return $languages;
    } */
    
    static function getLanguagesByCodeandApplication($application=null,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code FROM t_languages WHERE application=@@APPLICATION@@;")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return null;
        $languages=array();
        while ($language=$db->fetchArray())
        { 
            $languages[]=$language['code'];
        }            
        return $languages;
    }
    
    static function getI18nLanguagesFrontend($site=null)
    {
        static $cache=null;
        
        $name=($site instanceof Site)?$site->get('site_db_name'):$site;
        if ($cache[$name])
            return $cache[$name];
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code,is_active FROM ".Language::getTable()." WHERE application='frontend';")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return null;
        $languages=new LanguageCollection(null,$site);
        
        while ($language=$db->fetchObject('Language'))
        { 
            $languages[]=$language;
        }  
        $languages->sortByCountry();
        $cache[$name]=$languages;
        return $languages;
    }
    
    static function getI18nLanguagesAdmin($site=null)
    {
        static $cache=null;
        
        $name=($site instanceof Site)?$site->get('site_db_name'):$site;
        if ($cache[$name])
            return $cache[$name];
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT code,is_active FROM ".Language::getTable()." WHERE application='admin';")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return null;
        $languages=new LanguageCollection(null,$site);
        
        while ($language=$db->fetchObject('Language'))
        { 
            $languages[]=$language;
        }  
        $languages->sortByCountry();
        $cache[$name]=$languages;
        return $languages;
    }
    
    static function find($languages,$langue,$return_true=true,$return_false=false)
    {
        foreach ($languages as $language)
        {
            if ($language->get('code')==$langue)
                return ($return_true==null)?$langue:$return_true;
        }    
        return $return_false;
    }    
    
    /* Renumbering
     
     SELECT @position:=0;
UPDATE `t_languages` SET `position`=(SELECT @position:=@position+1) WHERE application='frontend'; 
     
     */
 }