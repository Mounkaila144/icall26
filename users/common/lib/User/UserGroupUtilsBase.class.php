<?php

class UserGroupUtilsBase {
       
    static function isAuthorizedGroupsForSelectionByUser($user_connected,mfArray $selection)
    {               
        if ($user_connected->getGuardUser()->isNotLoaded())
           return false;
        $settings=new UserSettings(null,$user_connected->getGuardUser()->getSite()); 
        if (!$user_connected->hasCredential(array(array('superadmin','users_new_user_as_telepro_manager','users_new_user_as_sales_manager','users_add_group_as_sales_manager','users_add_group_as_telepro_manager','users_add_group_as_admin'))))
           return false; 
        if ($selection->isEmpty())
           return array();     
        $query = new mfQuery();
        $query->select(Group::getFieldsAndKeyWithTable())
              ->from(Group::getTable())
              ->left(UserGroup::getInnerForJoin('group_id')." AND user_id='{user_id}'")
              ->where(Group::getTableField('application')."= 'admin'")
              ->where(Group::getTableField('name')."!='superadmin'")              
              ->orderby(Group::getTableField('name')." COLLATE UTF8_GENERAL_CI ASC");
        if ($user_connected->hasCredential(array(array('users_add_group_as_admin','superadmin'))))
        {
            $query->where(Group::getTableField('id')." IN('".$selection->implode("','")."')"); 
        }       
        if ($user_connected->hasCredential(array(array('users_new_user_as_telepro_manager','users_add_group_as_telepro_manager'))))
        {            
          if (!$settings->hasTeleproGroups())
              return array();
          $query->where(Group::getTableField('id')." IN('".$settings->getTeleproGroups()->getKeys()->implode("','")."')");
        }
        if ($user_connected->hasCredential(array(array('users_new_user_as_sales_manager','users_add_group_as_sales_manager'))))
        {    
          if (!$settings->hasSaleGroups())
              return array();
          $query->where(Group::getTableField('id')." IN('".$settings->getSaleGroups()->getKeys()->implode("','")."')");
        }
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user_connected->getGuardUser()->get('id')))
                ->setQuery((string)$query)               
                ->makeSiteSqlQuery($user_connected->getGuardUser()->getSite()); 
        if (!$db->getNumRows())
            return array();
        $groups=array();
        while ($row=$db->fetchObject('Group'))
        {
           $groups[]=$row;
        } 
        return $groups;
    }
    
    static function getGroupsUserList(User $user,$user_connected)
    {        
        if ($user->isNotLoaded())
           return false;
        $settings=UserSettings::load($user->getSite());      
        $query=new mfQuery();
        $query->select(Group::getFieldsAndKeyWithTable())
              ->from(Group::getTable())
              ->left(UserGroup::getInnerForJoin('group_id')." AND user_id='{user_id}'")
              ->where(Group::getTableField('application')."= @@APPLICATION@@")
              ->where(Group::getTableField('name')."!='superadmin'")
              ->orderby(Group::getTableField('name')." COLLATE UTF8_GENERAL_CI ASC");       
        if ($user_connected->hasCredential(array(array('users_new_user_as_telepro_manager'))))
        {   
          $query->where(Group::getTableField('id')." IN('".$settings->getTeleproGroups()->getKeys()->implode("','")."')");
        }
        if ($user_connected->hasCredential(array(array('users_new_user_as_sales_manager'))))
        {    
          $query->where(Group::getTableField('id')." IN('".$settings->getSaleGroups()->getKeys()->implode("','")."')");
        }
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->get('id')))
                ->setQuery((string)$query)               
                ->makeSqlQuery($user->get('application'),$user->getSite()); 
        if (!$db->getNumRows())
            return false;
        $groups=array();
        while ($row=$db->fetchObject('Group'))
        {
           $groups[]=$row;
        }
        return $groups;
    }

  /*  static function getGroupsAllowedUserList(User $user)
    {
        if (!$user->isValid())
           return array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($user->get('id')))
                ->setQuery("SELECT t_groups.id FROM t_groups
                            LEFT JOIN t_user_group ON t_user_group.group_id = t_groups.id AND user_id=%d
                            WHERE t_groups.application = @@APPLICATION@@ AND user_id IS NULL
                            ")               
                ->makeSqlQuery($user->get('application'),$this->getSite()); 
        if (!$db->getNumRows())
            return array();
        $groups=array();
        while ($row=$db->fetchArray())
        {
           $groups[]=$row['id'];
        }
        return $groups;
    }*/
    
     static function getGroupsUserbyUserList(User $user)
    {
        if (!$user->isLoaded())
           return array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($user->get('id')))
                ->setQuery("SELECT t_user_group.id
                            FROM t_groups
                            LEFT JOIN t_user_group ON t_user_group.group_id = t_groups.id 
                            WHERE t_groups.application = @@APPLICATION@@ AND user_id=%d;
                            ")               
                ->makeSqlQuery($user->get('application'),$user->getSite()); 
        if (!$db->getNumRows())
            return array();
        $groups=array();
        while ($row=$db->fetchArray())
        {
           $groups[]=$row['id'];
        }
        return $groups;
    } 
    
     static function isGroupsUserNotAllowed($user_id,$groups=array(),$application=null,$site=null)
    {
        if (!$groups)
           return false;
        $db=mfSiteDatabase::getInstance()
                ->setParameters((array)$user_id)
                ->setQuery("SELECT t_groups.id
                            FROM t_groups
                            LEFT JOIN t_user_group ON t_user_group.group_id = t_groups.id AND user_id=%d
                            WHERE t_groups.application@@IN_APPLICATION@@ AND user_id IS NULL AND t_groups.id IN (".implode(",",(array)$groups).");")               
                ->makeSqlQuery($application,$site); 
        if (!$db->getNumRows())
            return false;
        $groups_exist=array();
        while ($row=$db->fetchArray())
               $groups_exist[]=$row['id'];
        return array_diff($groups,$groups_exist);
        
    }
    
    static function removeAllGroupsForUser(User $user)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->get('id')))
                ->setQuery("DELETE FROM ".UserGroup::getTable().                           
                           " WHERE user_id='{user_id}';")
               ->makeSiteSqlQuery($user->getSite()); 
    }
    
    static function getUsersByGroupNameContains(mfArray $group_names,$options=null,$site=null)
    {
        $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
          $where[]="UPPER(".Group::getTableField('name').") LIKE '%%%%".strtoupper($name)."%%%%'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('contains'=>strtoupper($options)))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').")".
                                    ($options?" AND UPPER(".Group::getTableField('name').") LIKE '%%{contains}%%'":"").
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
     static function getUsersByGroupNameStarts(mfArray $group_names,$site)
    {
        $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
           $where[]="UPPER(".Group::getTableField('name').") LIKE '".strtoupper($name)."%%%%'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').")".                                  
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
    static function getUsersByGroupNameNotContains($group_names,$not_contains,$site=null) 
    {
        $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
            $where[]="UPPER(".Group::getTableField('name').") LIKE '%%%%".strtoupper($name)."%%%%'";
        $not_contains_where=new mfArray();
        $not_contains=$not_contains instanceof mfArray?$not_contains:new mfArray($not_contains);
        foreach ($not_contains as $not_contain)
               $not_contains_where[] ="UPPER(".Group::getTableField('name').") NOT LIKE '%%%%".strtoupper($not_contain)."%%%%'";        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('not_contains'=> strtoupper($not_contains)))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').") AND ".
                                    "(".$not_contains_where->implode(' AND ').")".                        
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
     static function getUsersByGroupNameEqual(mfArray $group_names,$site=null) 
    {
         $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
           $where[]="UPPER(".Group::getTableField('name').") ='".strtoupper($name)."'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').")".                                
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
    
    
    static function getUsersByGroupNameContainsForUsers(mfArray $group_names,mfArray $selection_users,$options=null,$site=null)
    {
        $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
          $where[]="UPPER(".Group::getTableField('name').") LIKE '%%%%".strtoupper($name)."%%%%'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('contains'=>strtoupper($options)))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').")".
                                    ($options?" AND UPPER(".Group::getTableField('name').") LIKE '%%{contains}%%'":"").
                                    " AND ".User::getTableField('id')." IN('".$selection_users->getKeys()->implode("','")."')".
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
     static function getUsersByGroupNameStartsForUsers(mfArray $group_names,mfArray $selection_users,$site)
    {
        $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
           $where[]="UPPER(".Group::getTableField('name').") LIKE '".strtoupper($name)."%%%%'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').")".                                 
                                    " AND ".User::getTableField('id')." IN('".$selection_users->getKeys()->implode("','")."')".
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
    static function getUsersByGroupNameNotContainsForUsers($group_names,mfArray $selection_users,$not_contains,$site=null) 
    {
        $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
            $where[]="UPPER(".Group::getTableField('name').") LIKE '%%%%".strtoupper($name)."%%%%'";
        
        $not_contains_where=new mfArray();
        $not_contains=$not_contains instanceof mfArray?$not_contains:new mfArray($not_contains);
        foreach ($not_contains as $not_contain)
               $not_contains_where[] ="UPPER(".Group::getTableField('name').") NOT LIKE '%%%%".strtoupper($not_contain)."%%%%'";        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('not_contains'=> strtoupper($not_contains)))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').") AND ".
                                    "(".$not_contains_where->implode(' AND ').") AND ".
                                    User::getTableField('id')." IN('".$selection_users->getKeys()->implode("','")."')".                               
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
     static function getUsersByGroupNameEqualForUsers(mfArray $group_names,mfArray $selection_users,$site=null) 
    {
         $users = new mfArray();
        $where=new mfArray();
        foreach ($group_names as $name)
           $where[]="UPPER(".Group::getTableField('name').") ='".strtoupper($name)."'";
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                           " WHERE ".Group::getTableField('application')."='admin' AND ".
                                    "(".$where->implode(' OR ').")".    
                                    " AND ".User::getTableField('id')." IN('".$selection_users->getKeys()->implode("','")."')".                                 
                           " GROUP BY ".User::getTableField('id').
                           ";")
                ->makeSiteSqlQuery($site); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $users;        
        while ($item=$db->fetchObject('User'))
        {
            $users[$item->get('id')]=$item->setSite($site)->loaded();
        }
        return $users;
    }
    
    
     static function getUserGroupsFromPager($pager)
    {
          if (!$pager->hasItems())
            return ;
    
        $db=mfSiteDatabase::getInstance();
         $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))  
                  ->setQuery("SELECT user_id ,GROUP_CONCAT(".Group::getTableField('name')." ORDER BY ".Group::getTableField('name')." ASC) as `groups`".
                                " FROM ".UserGroup::getTable().
                            " LEFT JOIN ".UserGroup::getOuterForJoin('group_id').    
                            " WHERE ".UserGroup::getTableField('user_id')." IN('".mfArray::create($pager->getKeys())->implode("','")."')".                                             
                            " GROUP BY user_id")          
                ->makeSiteSqlQuery($pager->getSite());
       //   echo $db->getQuery();
        if (!$db->getNumRows()) 
            return;             
         while($row= $db->fetchArray()) 
        {
          $pager[$row['user_id']]->groups=$row['groups']; 
        }
    }
}

