<?php

class ThemesUtils {
    
    protected function getThemesDirectory($application)
    {
      return mfConfig::get('mf_sites_dir')."/themes/".$application;
    }
    
    protected function getThemesFromFile($application)
    {
        return mfFileSystem::scandir(self::getThemesDirectory($application)."/",array("base"));     
    }   
    
    static function getListTheme($application)
    {
       $files=self::getThemesFromFile($application);     
       $themes=array();
       foreach ($files as $file)
       {
           if (($i18n= mfcontext::getInstance()->getI18n()))
                $i18n->addMessageI18nSources(mfConfig::get('mf_sites_dir')."/themes/".$application."/".$file."/i18n");         
           $themes[$file]=__($file);
       }    
       asort($themes);
       return $themes;
    }
    
    static function findThemes()
    {
        $themes=array();
        foreach (array('frontend','admin') as $application)
        {
            foreach (self::getThemesFromFile($application) as $file)
            {
                $themes[]=new ThemeCore($file,$application);
            }
        }           
        return $themes;        
    }
    
    static function findAllThemes()
    {
        $themes=array();
        foreach (array('frontend','admin','superadmin') as $application)
        {
            foreach (self::getThemesFromFile($application) as $file)
            {
                $themes['application'][]=new ThemeCore($file,$application);
            }
        }           
        return $themes;        
    }
    
    static function findApplicationTheme($themes,$application)
    {
        $themes_found=array();
        foreach ($themes as $theme)
        {
            if ($theme->get('application')==$application)
                $themes_found[$theme->get('name')]=$theme->get('name');                    
        }     
        return $themes_found;                
    }
    
    
    static function refresh()
    {       
        $themes=self::findThemes();        
        // Remove all themes admin not used
        $themes_admin=self::findApplicationTheme($themes, 'admin');
        $db=mfSiteDatabase::getInstance()
           ->setQuery("DELETE FROM ".Themes::getTable()." WHERE name NOT IN ('".implode("','",$themes_admin)."') AND application='admin';")               
           ->makeSqlQuerySuperAdmin();
        // Remove all themes frontend not used
        $themes_frontend=self::findApplicationTheme($themes, 'frontend');        
        $db=mfSiteDatabase::getInstance()
           ->setQuery("DELETE FROM ".Themes::getTable()." WHERE name NOT IN ('".implode("','",$themes_frontend)."') AND application='frontend';")               
           ->makeSqlQuerySuperAdmin();
        // Get existing modules
        $db->setQuery("SELECT * FROM ".Themes::getTable().";")               
           ->makeSqlQuerySuperAdmin();          
        if ($db->getNumRows())
        {
           while ($item=$db->fetchObject('themes'))
           {        
               if ($item->get('application')=='admin')
               {
                   if (in_array($item->get('name'),$themes_admin))
                     unset($themes_admin[$item->get('name')]);      
               }   
               else
               {
                   if (in_array($item->get('name'),$themes_frontend))
                     unset($themes_frontend[$item->get('name')]);     
               }    
           }    
        }  
        // Prepare And Save         
        $themesCollectionFrontend=new themesCollection(null,'frontend');
        foreach ($themes_frontend as $name)
        {
            $item=new Themes(null,'frontend');
            $item->add(array("name"=>$name,"is_active"=>"YES"));
            $item->set("preview",$item->getTheme()->getPreview());                
            $themesCollectionFrontend[]=$item;
        }  
        $themesCollectionFrontend->save();   
        // For Admin
        $themesCollectionAdmin=new themesCollection(null,'admin');
        foreach ($themes_admin as $name)
        {
            $item=new Themes(null,'admin');
            $item->add(array("name"=>$name,"is_active"=>"YES"));
            $item->set("preview",$item->getTheme()->getPreview());      
            $themesCollectionAdmin[]=$item;
        }              
        $themesCollectionAdmin->save();       
    }
    
   static function getFrontendThemesNotInThemes($themes)
   {  
        $values=array();
        foreach ($themes as $theme)       
           $values[]=$theme->get('name');         
        if ($values)
            $where=" name NOT IN('".implode("','",$values)."')";
        else
            $where="";
        $db=mfSiteDatabase::getInstance()
           ->setQuery("SELECT * FROM ".Themes::getTable()." WHERE application='frontend' AND ".$where.";")               
           ->makeSqlQuerySuperAdmin();          
        if (!$db->getNumRows())
            return array();
         $themes=new ThemesCollection();
         while ($theme=$db->fetchObject('Themes'))
         {
             $themes[$theme->get('name')]=$theme;
         }
         return $themes;
   } 
   
   
}

