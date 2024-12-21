<?php

class userPermissionUtils {
       /*
        * SELECT t_permissions.id,t_permissions.name,t_permissions.application,
                                   t_group_permission.group_id
                            FROM t_permissions
                            LEFT JOIN t_group_permission ON t_group_permission.permission_id = t_permissions.id AND group_id=%d
                            WHERE t_permissions.application@@IN_APPLICATION@@
        */
    static function getAllPermissions(User $user)
    {
        if (!$user->isloaded())
           return false;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($user->get('id')))
                ->setQuery("SELECT t_permissions.id,t_permissions.name,t_permissions.application,t_user_permission.user_id".
                            " FROM t_permissions ".
                            " LEFT JOIN t_user_permission ON t_user_permission.permission_id = t_permissions.id AND user_id=%d".
                            " WHERE t_permissions.application@@IN_APPLICATION@@ AND ".Permission::getTableField('name')." NOT LIKE 'superadmin%%%%'".
                            " ORDER BY  t_permissions.name ASC ".
                            ";")               
                ->makeSqlQuery($user->get('application'),$user->getSite()); 
        if (!$db->getNumRows())
            return array();
        $permissions=array();
        while ($row=$db->fetchObject('Permission'))
        {
           $permissions[]=$row;
        }
        return $permissions;
    }
 
 
    static function getPermissionsUserbyUserList(User $user)
    {
        if (!$user->isLoaded())
                return array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters((array)$user->get('id'))
                ->setQuery("SELECT t_user_permission.id
                            FROM t_permissions
                            LEFT JOIN t_user_permission ON t_user_permission.permission_id = t_permissions.id 
                            WHERE t_permissions.application = @@APPLICATION@@ AND user_id=%d;
                            ")               
                ->makeSqlQuery($user->get('application'),$user->getSite()); 
        if (!$db->getNumRows())
            return array();
        $permissions=array();
        while ($row=$db->fetchArray())
        {
           $permissions[]=$row['id'];
        }
        return $permissions;
    } 
    
    static function getPermissionsGroupByUserList($id)
    {
        
       $db=mfSiteDatabase::getInstance()
                ->setParameters($id)
                ->setQuery("SELECT t_group_permission.id
                            FROM t_permissions
                            LEFT JOIN t_group_permission ON t_group_permission.permission_id=t_permissions.id
                            LEFT JOIN t_user_group ON t_user_group.group_id=t_group_permission.group_id
                            WHERE t_permissions.application = @@APPLICATION@@ AND t_user_group.user_id=%d;
                            ")               
                ->makeSqlQuery(); 
        if (!$db->getNumRows())
            return array();
        $permissions=array();
        while ($row=$db->fetchArray())
        {
           $permissions[]=$row['id'];
        }
        return $permissions;
    }
    
    static function isPermissionsUserNotAllowed($user_id,$permissions=array(),$application=null,$site=null)
    {
        if (!$permissions)
           return false;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($group_id))
                ->setQuery("SELECT t_permissions.id
                            FROM t_permissions
                            LEFT JOIN t_user_permission ON t_user_permission.permission_id = t_permissions.id AND user_id=%d
                            WHERE t_permissions.application@@IN_APPLICATION@@ AND user_id IS NULL AND t_permissions.id IN (".implode(",",(array)$permissions).");")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return false;
        $permissions_exist=array();
        while ($row=$db->fetchArray())
               $permissions_exist[]=$row['id'];
        return array_diff($permissions,$permissions_exist);
        
    }
}

