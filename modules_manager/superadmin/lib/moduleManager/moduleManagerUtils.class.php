<?php

/*
 * Generated by SuperAdmin Generator date : 25/03/13 16:38:07
 */
 
class moduleManagerUtils {
    
    static $messages=array();
     
    static function getModuleManagers(Site $site)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".moduleManager::getTable().";")               
                 ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return null;
        $items=array();
        while ($row=$db->fetchObject('moduleManager'))
            $items[]=$row;
        return $items;
    }
    
    static function getLanguages(Site $site)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT DISTINCT(lang) FROM ".moduleManager::getTable().";")               
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
    
    static function getLanguagesSort(Site $site)
    {
        $db=mfSiteDatabase::getInstance()                
                ->setQuery("SELECT DISTINCT(lang) FROM ".moduleManager::getTable().";")               
                 ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return array();
        $languages=array();
        while ($language=$db->fetchArray())
        { 
           $languages[$language['lang']]=format_country($language['lang']); 
        }  
        asort($languages);
        return $languages;
    }
    
    static function getFieldValues($name,Site $site)
    {
        $values=array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT DISTINCT({name}) FROM ".moduleManager::getTable()." ORDER BY {name} ASC;")               
                 ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[$name]]=$value[$name];
        }      
        return $values;
    }
    
     static function getFieldValuesFormat($name,$format_helper,Site $site)
    {
        if (!function_exists($format_helper))
            throw new mfException("helper [".$format_helper."] doesn't exist.");
        $values=array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT DISTINCT({name}) FROM ".moduleManager::getTable()." ORDER BY {name} ASC;")               
                 ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[$name]]=$format_helper($value[$name]);
        }      
        return $values;
    }
    
    static function getFieldValuesForSelect($name,Site $site)
    {
        $values=array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".moduleManager::getKeyName()." FROM ".moduleManager::getTable()." ORDER BY {name} ASC;")               
                  ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[moduleManager::getKeyName()]]=$value[$name];
        }      
        return $values;
    }
    
    static function getFieldValuesForI18nSelect($name,$lang,$site)
    {
        $values=array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang,"name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".moduleManager::getKeyName()." FROM ".moduleManager::getTable()." WHERE lang='{lang}' ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[moduleManager::getKeyName()]]=$value[$name];
        }      
        return $values;
    }
    
    static function getFieldValuesForSelectFormat($name,$format_helper,Site $site)
    {
        if (!function_exists($format_helper))
            throw new mfException("helper [".$format_helper."] doesn't exist.");
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".moduleManager::getKeyName()." FROM ".moduleManager::getTable()." ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        while ($value=$db->fetchArray())
        { 
            $values[$value[moduleManager::getKeyName()]]=$format_helper($value[$name]);
        }      
        return $values;
    }
    
    static function getFieldValuesForI18nSelectFormat($name,$format_helper,$lang,Site $site)
    {
        if (!function_exists($format_helper))
            throw new mfException("helper [".$format_helper."] doesn't exist.");
        $values=array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang,"name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".moduleManager::getKeyName()." FROM ".moduleManager::getTable()." WHERE lang='{lang}' ORDER BY {name} ASC;")               
                  ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[moduleManager::getKeyName()]]=$format_helper($value[$name]);
        }      
        return $values;
    }

    static function getValuesAutoCompleteI18n($field,$search,$lang,$site=null)
    {
    
    }
    
    static function getValuesAutoComplete($field,$search,Site $site)
    {
      $values=array();
      $db=mfSiteDatabase::getInstance()
                ->setParameters(array('search'=>$search,'field'=>$field))
                ->setQuery("SELECT ".moduleManager::getKeyName().",".$field." FROM ".moduleManager::getTable()." WHERE {field} LIKE '{search}%%%%';")               
                  ->makeSiteSqlQuery($site); 
       if (!$db->getNumRows())
          return $values;
       while ($value=$db->fetchArray())
            $values[$value[moduleManager::getKeyName()]]=$value[$field];
       return $values;
    } 
    
    
    static function getSiteModulesList(Site $site)
    {
         $modules=array();
         foreach (glob(mfConfig::get('mf_sites_dir')."/".$site->get('site_db_name')."/modules/*",GLOB_ONLYDIR) as $file)
         {
            $modules[basename($file)]=$file;
         }   
         return $modules;
    }
    
    static function buildModulesList(Site $site)
    {
      //  self::truncate($site);
        $siteModules=self::getSiteModulesList($site);
        $coreModules=moduleManagerAdminUtils::getCoreModulesList();
        $modules=array_keys(array_merge($siteModules,$coreModules));
        // Remove all modules not used
        $db=mfSiteDatabase::getInstance()
            ->setQuery("DELETE FROM ".moduleManager::getTable()." WHERE name NOT IN ('".implode("','",$modules)."');")               
            ->makeSiteSqlQuery($site);
        // Get existing modules
        $db->setQuery("SELECT name FROM ".moduleManager::getTable().";")               
            ->makeSiteSqlQuery($site);
       $modulesDatabase=array();
       if ($db->getNumRows())
       {
           while ($row=$db->fetchArray())
           {  
               $modulesDatabase[]=$row['name'];
           }     
       }  
       $modulesToSave=array_diff($modules,$modulesDatabase);
       // Here all modules to save
       // Site Modules      
       $modules=new moduleManagerCollection(null,$site);
       foreach ($modulesToSave as $name)
       {           
           $item=new moduleManager(null,$site); 
           $item->set('name',$name);
           if (!$item->getModule()->hasConfigFile())
                 continue;
           $item->setConfigFromModule();             
           if ($item->getModule()->isSuperAdmin())
               continue;
           if ($item->getModule()->isCore())         
                $item->set('is_available','YES');          
           else
                $item->set('is_available','NO');
           $modules[]=$item;
       }          
       $modules->removeConfigCache(); // Remove all moduleConfigCache
       $modules->save();    
    }    
    
    static function truncate($site)
    {
        $db=mfSiteDatabase::getInstance();
        $db->setQuery("TRUNCATE ".moduleManager::getTable()." ;")               
           ->makeSiteSqlQuery($site); 
    }
    
 /*   protected static function getInstalledModulesForSite(Site $site)
    {
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".moduleManager::getTable()." WHERE status='installed';")               
                 ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $items=array();
        while ($row=$db->fetchObject('moduleManager'))
        {
            $row->site=$site;
            $items[]=$row;
        }    
        return $items;
    }*/
              
  /*  static function updateModulesForSite(Site $site)
    {
        self::clearMessages();
         self::$site_uptodate=false;
        $coreModules=moduleManagerAdminUtils::getCoreModules();
        foreach ($coreModules as $module)
        {            
            if ($module->getInstaller($site)->isUpToDate())
                 continue;
            $module->getInstaller()->upGrade();
            self::addMessage(__("module [%s] is updated.",$module->get('name')));
        }
        $modules=self::getInstalledModulesForSite($site);
        foreach ($modules as $module)
        {            
            if ($module->getInstaller()->isUpToDate())
                 continue;
            $module->getInstaller()->upGrade();
            self::addMessage(__("module [%s] is updated.",$module->get('name')));
        }
        
        if (!self::hasMessages())
        {
            self::$site_uptodate=true;
            self::addMessage(__('All modules are uptodate.'));
        }    
    }*/
    
    
   /* protected function clearMessages()
    {
        self::$messages=array();
    }
    
    protected function addMessage($message)
    {
        self::$messages[]=$message;
    }
    
    static function hasMessages()
    {
        return !empty(self::$messages);
    }
    
    static function getMessages()
    {
        return self::$messages;
    }*/
    
   /* static function isSiteUptodate(Site $site)
    {        
        $coreModules=moduleManagerAdminUtils::getCoreModules();
        foreach ($coreModules as $module)
        {            
            if (!$module->getInstaller($site)->isUpToDate())
                 return false;         
        }
        $modules=self::getInstalledModulesForSite($site);
        foreach ($modules as $module)
        {            
            if (!$module->getInstaller()->isUpToDate())
                return false;       
        }        
        return true;
    }*/
   

}
