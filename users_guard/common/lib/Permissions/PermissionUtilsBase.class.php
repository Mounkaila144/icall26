<?php

class PermissionUtilsBase {
    
    static function isPermissionsExists($name,$permissions,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT ".$name." FROM ".Permission::getTable().                      
                       " WHERE ".Permission::getTableField($name)." IN('".implode("','",$permissions)."')".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $permissions;
        $unknown=$permissions;    
        while ($row=$db->fetchArray())
        {          
            if (($key=array_search($row[$name],$permissions))!==false)
            {
                unset($unknown[$key]);
            }                   
        }  
        return $unknown;   
    }
    
    static function setPermissionsForGroupImport(Group $group,$permissions)
    {
        if ($group->isNotLoaded())
           return ;        
        // Find unknown categories
        $unKnown=self::isPermissionsExists('name',$permissions,$group->getSite());       
        // take only existing ProductCategoryI18N not yet linked with group
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('group_id'=>$group->get('id')))
            ->setQuery("SELECT ".Permission::getFieldsAndKeyWithTable()." FROM ".Permission::getTable().
                       " LEFT JOIN ".GroupPermission::getInnerForJoin('permission_id').
                            " AND ".GroupPermission::getTableField('group_id')."={group_id}".
                       " WHERE ".GroupPermission::getTableField('id')." IS NULL".                    
                       " AND ".Permission::getTableField('name')." IN('".implode("','",$permissions)."')".
                       ";")               
            ->makeSiteSqlQuery($group->getSite());  
        if (!$db->getNumRows())
            return $unKnown;;
        $collection=new GroupPermissionCollection(null,$group->getSite());
        while ($item=$db->fetchObject('Permission'))
        {               
            $join=new GroupPermission(null,$group->getSite());
            $join->add(array('group_id'=>$group,'permission_id'=>$item));
            $collection[]=$join;
        }
        $collection->save();           
        return $unKnown;
    }
        
    static  function getPermissionsId($site=null)
    {
       $permissions=array();
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT id FROM ".Permission::getTable().       
                       " WHERE application='admin'".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $permissions;       
        while ($row=$db->fetchRow())
        {          
          $permissions[$row[0]]=$row[0];                  
        }  
        return $permissions;   
    }
    
    
    
    static function ImportPermissionsForGroup(Group $group,mfArray $permissions)
    {        
        if ($group->isNotLoaded() || $permissions->isEmpty())
            return ;                
        $permission_collection=new PermissionCollection(null,'admin',$group->getSite());
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())
            ->setQuery("SELECT ".Permission::getFieldsAndKeyWithTable()." FROM ".Permission::getTable().                                    
                       " WHERE ".Permission::getTableField('name')." IN('".$permissions->implode("','")."') AND ".
                                Permission::getTableField('name')."!='superadmin'".
                       ";")               
            ->makeSiteSqlQuery($group->getSite());        
        if ($db->getNumRows())
        {           
           while ($item=$db->fetchObject('Permission'))
           {
               $permission_collection[$item->get('name')]=$item->loaded()->setSite($group->getSite());
           }   
           $permission_collection->loaded();
        }
        foreach ($permissions as $permission)
        {
            if (isset($permission_collection[$permission]) || $permission=='superadmin')
                continue;
            $permission_to_create=new Permission(null,'admin',$group->getSite());
            $permission_to_create->set('name',$permission);
            $permission_collection[$permission_to_create->get('name')]=$permission_to_create;
        }    
        $permission_collection->save();               
        
        $group_permission_collection = new GroupPermissionCollection(null,$group->getSite());
        foreach ($permission_collection as $permission)
        {        
            $group_permission=new GroupPermission(null,$group->getSite());
            $group_permission->add(array('group_id'=>$group,'permission_id'=>$permission));
            $group_permission_collection[]=$group_permission;
        }            
     //  echo "<pre>"; var_dump($group_permission_collection); echo "</pre>";
       $group_permission_collection->save();                
    }
    
    
    static function ImportPermissionsForExistingGroup(Group $group,mfArray $permissions)
    {        
        if ($permissions->isEmpty())
            return ;     
        $csv=new PermissionsSystemCsvFile();
        $system_permissions=$csv->getData();
        // Make sure created in system
        foreach ($permissions as $index=>$permission)
        {
            if (!isset($system_permissions[$permission]))
               unset($permissions[$index]); 
        }
       
        $permission_collection=new PermissionCollection(null,'admin',$group->getSite());
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())
            ->setQuery("SELECT ".Permission::getFieldsAndKeyWithTable()." FROM ".Permission::getTable().                                    
                       " WHERE ".Permission::getTableField('name')." IN('".$permissions->implode("','")."') AND ".
                                Permission::getTableField('name')."!='superadmin'".
                       ";")               
            ->makeSiteSqlQuery($group->getSite());        
        if ($db->getNumRows())
        {           
           while ($item=$db->fetchObject('Permission'))         
           {        
               $permission_collection[$item->get('id')]=$item->loaded()->setSite($group->getSite());           
               $permissions->findAndRemove($item->get('name'));
           }
           $permission_collection->loaded();          
        }
        foreach ($permissions as $permission)
        {           
            if ($permission=='superadmin')
                continue;
            $permission_to_create=new Permission(null,'admin',$group->getSite());
            $permission_to_create->set('name',$permission);
            $permission_collection[]=$permission_to_create;
        }    
        $permission_collection->save();               
        
        // Add useful group permissions
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('group_id'=>$group->get('id')))
            ->setQuery("SELECT ".Permission::getTableField('id')." FROM ".Permission::getTable().                                    
                       " LEFT JOIN ".GroupPermission::getInnerForJoin('permission_id')." AND " .GroupPermission::getTableField('group_id')."='{group_id}'".
                       " WHERE ".Permission::getTableField('id')." IN('".$permission_collection->getKeys()->implode("','")."') AND ".
                                GroupPermission::getTableField('id')." IS NULL AND ".
                                Permission::getTableField('name')."!='superadmin'".
                       ";")               
            ->makeSiteSqlQuery($group->getSite());    
       //  echo $db->getQuery();        
        if (!$db->getNumRows())
            return ;
        $group_permission_collection = new GroupPermissionCollection(null,$group->getSite());
        while ($row=$db->fetchArray())         
        {
            $group_permission=new GroupPermission(null,$group->getSite());
            $group_permission->add(array('group_id'=>$group,'permission_id'=>$row['id']));
            $group_permission_collection[]=$group_permission;
        }        
        $group_permission_collection->save();       
    }
    
    
    static  function getNotSuperadminPermissionsForSelect($site=null)
    {
       $permissions=new mfArray();
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT id,name FROM ".Permission::getTable().       
                       " WHERE application='admin'".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $permissions;       
        while ($row=$db->fetchRow())
        {          
          $permissions[$row[0]]=$row[1];                  
        }  
        return $permissions;   
    }
    
    static  function getNotSuperadminPermissionsByNameForSelect($site=null)
    {
       $permissions=new mfArray();
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT id,name FROM ".Permission::getTable().       
                       " WHERE application='admin'".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $permissions;       
        while ($row=$db->fetchRow())
        {          
          $permissions[$row[1]]=$row[1];                  
        }  
        return $permissions;   
    }
    
    
     static  function getPermissionsFromSelection(mfArray $selection,$site=null)
    {
       $permissions=new PermissionCollection(null,'admin',$site);
       if ($selection->isEmpty())
           return $permissions;
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Permission::getTable().       
                       " WHERE id IN('".$selection->implode("','")."') ". //AND name NOT LIKE '%superadmin%".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $permissions;       
        while ($item=$db->fetchObject('Permission'))
        {          
          $permissions[$item->get('id')]=$item->loaded()->setSite($site);                  
        }       
        return $permissions;   
    }
    
   static  function getPermissionsExceptSuperAdminFromSelection(mfArray $selection,$site=null)
    {
       $permissions=new PermissionCollection(null,'admin',$site);
       if ($selection->isEmpty())
           return $permissions;
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Permission::getTable().       
                       " WHERE name IN('".$selection->implode("','")."') AND name NOT LIKE 'superadmin%%'".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $permissions;       
        while ($item=$db->fetchObject('Permission'))
        {          
          $permissions[$item->get('id')]=$item->loaded()->setSite($site);                  
        }       
        return $permissions;   
    }
    
    
    static function getPermissionsByNames(mfArray $names,$site=null)
    {
        $permissions=new PermissionCollection(null,'admin',$site);
        $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Permission::getTable().       
                       " WHERE name IN('".$names->implode("','")."') AND application='admin'".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $permissions;       
        while ($item=$db->fetchObject('Permission'))
        {          
           $permissions[$item->get('id')]=$item->loaded()->setSite($site);                  
        }       
        return $permissions;   
    }
    
    static function deletePermissionsByNames(mfArray $names,$site=null)
    {             
        $db=mfSiteDatabase::getInstance()                      
            ->setQuery("DELETE FROM ".Permission::getTable().       
                       " WHERE name IN('".$names->implode("','")."') AND application='admin'".
                       ";")               
            ->makeSiteSqlQuery($site);                 
    }
     
}    