<?php


class GroupUtilsBase {
    
 
    
    static function isGroupsExists($name,$list,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT ".$name." FROM ".Group::getTable().                      
                       " WHERE ".Group::getTableField($name)." IN('".implode("','",$list)."')".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $list;
        $unknown=$list;    
        while ($row=$db->fetchArray())
        {          
            if (($key=array_search($row[$name],$list))!==false)
            {
                unset($unknown[$key]);
            }                   
        }  
        return $unknown;   
    }
    
    static function setGroupsForUserImport(User $user,$groups)
    {
        if ($user->isNotLoaded())
           return ;        
        // Find unknown categories
        $unKnown=self::isGroupsExists('name',$groups,$user->getSite());       
        // take only existing ProductCategoryI18N not yet linked with group
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('user_id'=>$user->get('id')))
            ->setQuery("SELECT ".Group::getFieldsAndKeyWithTable()." FROM ".Group::getTable().
                       " LEFT JOIN ".UserGroup::getInnerForJoin('group_id').
                            " AND ".UserGroup::getTableField('user_id')."={user_id}".
                       " WHERE ".UserGroup::getTableField('id')." IS NULL".                    
                       " AND ".Group::getTableField('name')." IN('".implode("','",$groups)."')".
                       ";")               
            ->makeSiteSqlQuery($user->getSite());  
        if (!$db->getNumRows())
            return $unKnown;;
        $collection=new UserGroupCollection(null,$user->getSite());
        while ($item=$db->fetchObject('Group'))
        {               
            $join=new UserGroup(null,$user->getSite());
            $join->add(array('user_id'=>$user,'group_id'=>$item,'is_active'=>'YES'));
            $collection[]=$join;
        }
        $collection->save();           
        return $unKnown;
    }
    
    static  function getGroups($application,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Group::getTable(). 
                       " WHERE application='".$application."' AND name!='superadmin'".                    
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return array();
        $groups=array();
        while ($item=$db->fetchObject('Group'))
        {          
             $item->site=$site;
             $groups[$item->get('id')]=$item->loaded();                 
        }  
        return $groups;   
    }
    
    static  function getGroupsFromList(mfArray $list,$site=null)
    {
        $like=new mfArray();
        foreach ($list as $cond)
            $like[]=" `name` LIKE '%%%%".$cond."%%%%'";        
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Group::getTable(). 
                       " WHERE application='admin' AND (".$like->implode(" OR ").")".
                       ";")               
            ->makeSiteSqlQuery($site);        
        if (!$db->getNumRows())
            return array();
        $groups=array();
        while ($item=$db->fetchObject('Group'))
        {          
             $item->site=$site;
             $groups[$item->get('id')]=$item->loaded();                 
        }  
        return $groups;   
    }
    
    static function getAdminGroupsForSelect($site=null)
    {
       static $groups;
       
       $groups=new mfArray();
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT name,id FROM ".Group::getTable(). 
                       " WHERE application='admin' ".
                       " AND name!='superadmin'".
                       " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $groups;       
        while ($row=$db->fetchArray())
        {                       
             $groups[$row['id']]=$row['name'];                 
        }  
        return $groups;   
    }
    
    static function getTeleproGroupsByIdForSelect(mfArray $selection,$site=null)
    {        
        $groups=new mfArray();
        if ($selection->isEmpty() || ($selection->count()==1 && $selection->getFirst()==""))
        {
            $group=new Group(array('name'=>'telepro'),'admin',$site);
            if ($group->isLoaded())
                $groups[$group->get('id')]=$group;
            return $groups;
        }        
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Group::getTable(). 
                       " WHERE application='admin' AND id IN('".$selection->implode("','")."')".
                       " AND name!='superadmin'".
                       " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $groups;       
         while ($item=$db->fetchObject('Group'))
        {                       
             $groups[$item->get('id')]=$item->loaded()->setSite($site);                 
        }   
        return $groups; 
    }
    
    static function getSaleGroupsByIdForSelect(mfArray $selection,$site=null)
    {        
        $groups=new mfArray();         
        if ($selection->isEmpty() || ($selection->count()==1 && $selection->getFirst()==""))
        {            
            $group=new Group(array('name'=>'commercial'),'admin',$site);
            if ($group->isLoaded())
                $groups[$group->get('id')]=$group;
            return $groups;
        }        
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Group::getTable(). 
                       " WHERE application='admin' AND id IN('".$selection->implode("','")."')".
                       " AND name!='superadmin'".
                       " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $groups;       
         while ($item=$db->fetchObject('Group'))
        {                       
             $groups[$item->get('id')]=$item->loaded()->setSite($site);                 
        }   
        return $groups; 
    }
    
    static function getGroupsExceptedForSelect(Group $excepted_group)
    {
        $groups=new mfArray();       
       $db=mfSiteDatabase::getInstance()    
               ->setParameters(array('excepted_id'=>$excepted_group->get('id')))
            ->setQuery("SELECT name,id FROM ".Group::getTable(). 
                       " WHERE application='admin' ".
                       " AND name!='superadmin'".
                       " AND id!='{excepted_id}'".
                       " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC".
                       ";")               
            ->makeSiteSqlQuery($excepted_group->getSite());   
        if (!$db->getNumRows())
            return $groups;       
        while ($row=$db->fetchArray())
        {                       
             $groups[$row['id']]=$row['name'];                 
        }  
        return $groups;   
    }
    
     static function getGroupsByIds(mfArray $groups,$site=null)
    {
//        echo "<pre>"; var_dump($groups); echo "</pre>";
        $groups_loaded = new mfArray();
        $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Group::getTable(). 
                       " WHERE ".Group::getTableField("id")." IN ('".$groups->implode("','")."')".
                       " AND application='admin'".
                       ";")               
            ->makeSiteSqlQuery($site);   
//        echo $db->getQuery()."<br />";
        if (!$db->getNumRows())
            return $groups_loaded;
        
        while ($item=$db->fetchObject('Group'))
        {          
            $item->site=$site;
            $groups_loaded[$item->get('id')]=$item->loaded();                 
        }  
        return $groups_loaded;   
    }
    
    
    function getActiveGroupsForSelect($site=null)
    {
       $groups=new mfArray();
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT name,id FROM ".Group::getTable(). 
                       " WHERE application='admin' ".
                       " AND name!='superadmin'".
                       " ORDER BY UPPER(name) COLLATE utf8_general_ci ASC".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $groups;       
        while ($row=$db->fetchArray())
        {                       
             $groups[$row['id']]=$row['name'];                 
        }  
        return $groups;  
    }
    
    
    static function deleteGroupUnusedByUser()   
    {         
        $deleted_groups = new mfArray();
         
        return $deleted_groups;

    }
    
     static  function getGroupsFromSelection(mfArray $selection,$site=null)
    {
       $groups=new GroupCollection(null,'admin',$site);
       if ($selection->isEmpty())
           return $groups;
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT * FROM ".Group::getTable().       
                       " WHERE id IN('".$selection->implode("','")."')".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $groups;       
        while ($item=$db->fetchObject('Group'))
        {          
          $groups[$item->get('id')]=$item->loaded()->setSite($site);                  
        }       
        return $groups;   
    }
}
