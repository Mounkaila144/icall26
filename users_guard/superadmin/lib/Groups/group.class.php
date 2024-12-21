<?php

class Group extends GroupBase {
     
   // SPECIFIC METHODS
    function getPermissions()
    {
      if (!$this->isLoaded())
          return null;
      $db=mfSiteDatabase::getInstance()
                ->setParameters(array($this->get('id')))
                ->setQuery("SELECT t_permissions.id,t_permissions.name,t_permissions.application,
                                   t_group_permission.group_id
                            FROM t_permissions
                            LEFT JOIN t_group_permission ON t_group_permission.permission_id = t_permissions.id AND group_id=%d
                            WHERE group_id IS NOT NULL AND t_permissions.application@@IN_APPLICATION@@
                            ")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return false;
        $permissions=array();
        while ($row=$db->fetchObject('Permission'))
           $permissions[]=$row;
        return $permissions;    
    }
    
    /*
     * SELECT * FROM t_groups WHERE name='superadmin' AND application='admin' ORDER BY id ASC LIMIT 0,1;
     */
    static function deleteFirst($name,$application,$site=null)
    {    
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('name'=>$name,'target_application'=>$application))
                ->setQuery("SELECT * FROM ".self::getTable().
                        " WHERE name='{name}' AND application='{target_application}'".
                        " ORDER BY id ASC ".
                        " LIMIT 0,1".
                        ";")
                 ->makeSiteSqlQuery($site); 
         if (!$db->getNumRows())
            return ;
        $db->fetchObject('Group')->loaded()->setSite($site)->delete();        
    }
}
