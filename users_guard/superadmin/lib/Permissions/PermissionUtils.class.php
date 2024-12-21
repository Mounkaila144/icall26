<?php

class PermissionUtils extends PermissionUtilsBase {
    
    
    static function removePermissionsForSites(SiteCollection $sites,mfArray $permissions )
    {               
        if ($sites->isEmpty() || $permissions->isEmpty())
            return ;     
         foreach ($sites as $site)
        {
            try
            {               
                $db=mfSiteDatabase::getInstance()
                    ->setParameters(array())                
                    ->setQuery("DELETE FROM ".Permission::getTable().                         
                               " WHERE application = 'admin' AND name IN('".$permissions->implode("','")."')".
                               ";")               
                    ->makeSiteSqlQuery($site);  
            }
            catch (mfException $e)
            {
                
            }
        } 
    }
    
    static function getPermissions(mfArray $list)
    {
       $permissions=new PermissionCollection();
       $db=mfSiteDatabase::getInstance()
            ->setParameters()
            ->setQuery("SELECT * FROM ".Permission::getTable().
                       " WHERE name IN('".$list->implode("','")."') AND application='admin'".
                       " GROUP BY name".
                       ";")
            ->makeSqlQuerySuperAdmin();
         if (!$db->getNumRows())
            return $permissions;        
        while ($item=$db->fetchObject('Permission'))
        {          
           $permissions[]=$item->loaded();
        }     
        return $permissions; 
    }
}    