<?php

class GroupPermissionUtils {
    
    static function getAllPermissions(Group $group)
    {
        if (!$group->isLoaded())
           return false;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($group->get('id')))
                 ->setQuery("SELECT t_permissions.id,t_permissions.name,t_permissions.application,
                                   t_group_permission.group_id
                            FROM t_permissions
                            LEFT JOIN t_group_permission ON t_group_permission.permission_id = t_permissions.id AND t_group_permission.group_id=%d
                            WHERE t_permissions.application@@IN_APPLICATION@@
                            ORDER BY  t_permissions.name ASC
                            ")            
                ->makeSqlQuery($group->get('application'),$group->getSite()); 
        if (!$db->getNumRows())
            return false;
        $permissions=array();
        while ($row=$db->fetchObject('Permission'))
        {
           $permissions[]=$row;
        }
        return $permissions;
    }
        
    
    static function getAllPermissionsGroupByPermissionGroup(Group $group)
    {
        if (!$group->isLoaded())
           return false;
        $lang=mfContext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('group_id'=>$group->get('id'),'lang'=>$lang))
                ->setObjects(array('Permission','PermissionGroup','PermissionGroupI18n','GroupPermission'))
                ->setQuery("SELECT {fields} ".
                           " FROM ".Permission::getTable().                         
                           " LEFT JOIN ".GroupPermission::getInnerForJoin('permission_id')." AND ".GroupPermission::getTableField('group_id')."={group_id}".
                           " LEFT JOIN ".Permission::getOuterForJoin('group_id').
                           " LEFT JOIN ".PermissionGroupI18n::getInnerForJoin('group_id')." AND ".PermissionGroupI18n::getTableField('lang')."='{lang}'".
                           " WHERE t_permissions.application@@IN_APPLICATION@@ AND ".Permission::getTableField('name')." NOT LIKE 'superadmin%%%%'".
                           " ORDER BY  t_permissions.name ASC".
                           ";")                       
                ->makeSqlQuery($group->get('application'),$group->getSite()); 
        if (!$db->getNumRows())
            return false;
        $permissions_group=array(); 
        while ($items=$db->fetchObjects())
        {                        
           if ($items->hasPermissionGroup())               
           {    
                if ($items->hasPermissionGroupI18n())
                    $items->getPermissionGroup()->setPermissionGroupI18n($items->getPermissionGroupI18n());
                if (!isset($permissions_group[$items->getPermissionGroup()->get('id')]))
                    $permissions_group[$items->getPermissionGroup()->get('id')]=$items->getPermissionGroup();                
                $items->getPermission()->set('in_group',$items->hasGroupPermission());
                $permissions_group[$items->getPermissionGroup()->get('id')]->addPermission($items->getPermission());        
           }
           else
           {
             if (!isset($permissions_group["null"]))
                 $permissions_group["null"]=new PermissionGroup(null,$group->getSite());
              $items->getPermission()->set('in_group',$items->hasGroupPermission());
             $permissions_group["null"]->addPermission($items->getPermission()) ;
           }          
        }      
       // var_dump($permissions_group);
        return $permissions_group;
    }
    
     static function getAllPermissionsGroupByPermissionGroupForSuperadmin(Group $group)
    {
        if (!$group->isLoaded())
           return false;
        $lang=mfContext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('group_id'=>$group->get('id'),'lang'=>$lang))
                ->setObjects(array('Permission','PermissionGroup','PermissionGroupI18n','GroupPermission'))
                ->setQuery("SELECT {fields} ".
                           " FROM ".Permission::getTable().                         
                           " LEFT JOIN ".GroupPermission::getInnerForJoin('permission_id')." AND ".GroupPermission::getTableField('group_id')."={group_id}".
                           " LEFT JOIN ".Permission::getOuterForJoin('group_id').
                           " LEFT JOIN ".PermissionGroupI18n::getInnerForJoin('group_id')." AND ".PermissionGroupI18n::getTableField('lang')."='{lang}'".
                           " WHERE t_permissions.application@@IN_APPLICATION@@ ".
                           " ORDER BY  t_permissions.name ASC".
                           ";")                       
                ->makeSqlQuery($group->get('application'),$group->getSite()); 
        if (!$db->getNumRows())
            return false;
        $permissions_group=array(); 
        while ($items=$db->fetchObjects())
        {                        
           if ($items->hasPermissionGroup())               
           {    
                if ($items->hasPermissionGroupI18n())
                    $items->getPermissionGroup()->setPermissionGroupI18n($items->getPermissionGroupI18n());
                if (!isset($permissions_group[$items->getPermissionGroup()->get('id')]))
                    $permissions_group[$items->getPermissionGroup()->get('id')]=$items->getPermissionGroup();                
                $items->getPermission()->set('in_group',$items->hasGroupPermission());
                $permissions_group[$items->getPermissionGroup()->get('id')]->addPermission($items->getPermission());
              //  echo "Group=".$items->getPermissionGroup()->get('name')." permission=".$items->getPermission()->get('name')."<br/>";
           }
           else
           {
             if (!isset($permissions_group["null"]))
                 $permissions_group["null"]=new PermissionGroup(null,$group->getSite());
             $permissions_group["null"]->addPermission($items->getPermission()) ;
           }          
        }      
       // var_dump($permissions_group);
        return $permissions_group;
    }
    
 /*   static function getPermissionsAllowedGroupList($group_id,$application=null,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($group_id))
                ->setQuery("SELECT t_permissions.id FROM t_permissions
                            LEFT JOIN t_group_permission ON t_group_permission.permission_id = t_permissions.id AND group_id=%d
                            WHERE t_permissions.application@@IN_APPLICATION@@ AND group_id IS NULL
                            ")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return array();
        $permissions=array();
        while ($row=my_sql_fetch_assoc($db->getResource()))
        {
           $permissions[]=$row['id'];
        }
        return $permissions;
    }*/
    
     static function getPermissionsGroupbyGroupList(Group $group,$application=null,$site=null)
    {
        if (!$group->isLoaded())
           return array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($group->get('id')))
                ->setQuery("SELECT t_group_permission.id
                            FROM t_permissions
                            LEFT JOIN t_group_permission ON t_group_permission.permission_id = t_permissions.id 
                            WHERE t_permissions.application@@IN_APPLICATION@@ AND t_group_permission.group_id=%d;
                            ")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return array();
        $permissions=array();
        while ($row=$db->fetchArray())
        {
           $permissions[]=$row['id'];
        }
        return $permissions;
    }
    
    static function isPermissionsGroupNotAllowed($group_id,$permissions=array(),$application=null,$site=null)
    {
        if (!$permissions)
           return false;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($group_id))
                ->setQuery("SELECT t_permissions.id
                            FROM t_permissions
                            LEFT JOIN t_group_permission ON t_group_permission.permission_id = t_permissions.id AND t_group_permission.group_id=%d
                            WHERE t_permissions.application@@IN_APPLICATION@@ AND t_group_permission.group_id IS NULL AND t_permissions.id IN (".implode(",",(array)$permissions).");")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return false;
        $permissions_exist=array();
        while ($row=$db->fetchArray())
               $permissions_exist[]=$row['id'];
        return array_diff($permissions,$permissions_exist);
        
    }
    /*
     SELECT t_group_permission.id,t_group_permission.permission_id,t_group_permission.group_id,t_permissions.name FROM t_group_permission INNER JOIN t_permissions ON t_group_permission.permission_id=t_permissions.id WHERE t_permissions.application='admin' AND t_permissions.name IN ('contract_documents_form_list','app_domoprime_yousign_contract_documents_forms')
     * 
     SELECT t_group_permission.id as `GroupPermission.id`,t_group_permission.permission_id as `GroupPermission.permission_id`,t_group_permission.group_id as `GroupPermission.group_id`,t_permissions.id as `Permission.id`,t_permissions.name as `Permission.name`,t_permissions.application as `Permission.application`,t_permissions.group_id as `Permission.group_id`,t_permissions.updated_at as `Permission.updated_at`,t_permissions.created_at as `Permission.created_at` FROM t_group_permission INNER JOIN t_permissions ON t_permissions.id=t_group_permission.permission_id WHERE t_permissions.application='admin' AND t_permissions.name IN ('contract_documents_form_list','app_domoprime_yousign_contract_documents_forms');
     * 
     SELECT t_group_permission.id,t_group_permission.permission_id,t_group_permission.group_id,t_permissions.name FROM t_group_permission INNER JOIN t_permissions ON t_group_permission.permission_id=t_permissions.id WHERE t_permissions.application='admin' AND t_permissions.name IN ('contract_documents_form_list_class','app_domoprime_yousign_contract_documents_forms_class')
     */
    
     static function processPermissionPermutation($site=null)
    {        
        // 0 - Création des nouvelles permissions
        $permission_document=new Permission('contract_documents_form_list_class','admin',$site);
        $permission_document->save();
        $permission_yousign_document=new Permission('app_domoprime_yousign_contract_documents_forms_class','admin',$site);
        $permission_yousign_document->save();
        
        //1-récupérer les groupes_permissions      
        $db = mfSiteDatabase::getInstance();
        $db->setObjects(array('GroupPermission','Permission'))
           ->setParameters(array())
           ->setQuery("SELECT {fields} FROM ".GroupPermission::getTable().
                      " INNER JOIN ".GroupPermission::getOuterForJoin('permission_id').
                      " WHERE ".Permission::getTableField('application')."='admin' AND ".Permission::getTableField('name').
                        " IN ('contract_documents_form_list','app_domoprime_yousign_contract_documents_forms')".
                      ";")
           ->makeSiteSqlQuery($site);     
        if(!$db->getNumRows())
            return;
        $groups_permissions_old = new GroupPermissionCollection(null,$site);       
        while($items = $db->fetchObjects())
        {
            $group_permission = $items->getGroupPermission();
            $group_permission->set('permission_id',$items->getPermission());
            $groups_permissions_old[] = $group_permission;
        }
        $groups_permissions_old->loaded();
        
        //2-pour chaque groupe_permession créer un autre groupe_permession avec le m groupe_id et la permession convenable     
        $groups_permissions_new = new GroupPermissionCollection(null,$site);
        foreach($groups_permissions_old as $group_permission)
        {
            $item = new GroupPermission(null,$site);
            $item->add(array('group_id'=>$group_permission->get('group_id'),
                             'permission_id'=>$group_permission->getPermission()->get('name')=='contract_documents_form_list'?$permission_document:$permission_yousign_document
                      ));          
            $groups_permissions_new[] = $item;
        }
        $groups_permissions_new->save();
        
        //3-Supprimer les anciens group_permissions
        $groups_permissions_old->delete();
    }
    
    static function addAdminPermissionsForAllGroups(mfArray $permissions,$site=null)
    {        
        $permission_collection=new PermissionCollection(null,'admin',$site);
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".Permission::getTable().
                           " WHERE application='admin' AND name IN ('".$permissions->implode("','")."');")               
                ->makeSiteSqlQuery($site);
        if($db->getNumRows())
        {
            while($item = $db->fetchObject('Permission'))        
            {
                $permission_collection[]=$item->loaded()->setSite($site);
                $permissions->findAndRemove($item->get('name'));
            }
            $permission_collection->loaded();
        }
        foreach ($permissions as $name)
        {
            $item=new Permission(null,'admin',$site);
            $item->add(array('name'=>$name,'application'=>'admin'));           
            $permission_collection[]=$item;
            
        }    
        $permission_collection->save();
       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".Group::getFieldsAndKeyWithTable()." FROM ".Group::getTable().
                           " LEFT JOIN ".GroupPermission::getInnerForJoin('group_id'). " AND ".GroupPermission::getTableField('permission_id')." IN('".$permission_collection->getValuesByField('id')->implode("','")."')".                          
                           " WHERE ".Group::getTableField('application')."='admin' ". 
                                    " AND ".Group::getTableField('name')."!='superadmin'".                                    
                                    " AND ".GroupPermission::getTableField('id')." IS NULL".
                           ";")               
                ->makeSiteSqlQuery($site);
        if(!$db->getNumRows())
            return;
        $group_collection =new GroupCollection(null,$site);
        while($item = $db->fetchObject('Group'))
        {
             $group_collection[]=$item->loaded()->setSite($site);
        }
        
        $permission_group_collection =new GroupPermissionCollection(null,$site);
        foreach ($permission_collection as $permission)
        {
            foreach ($group_collection as $group)
            {
                $item=new GroupPermission(null,$site);
                $item->add(array('group_id'=>$group,'permission_id'=>$permission));
                $permission_group_collection[]=$item;
            }    
        }  
        $permission_group_collection->save();       
    }        
}

