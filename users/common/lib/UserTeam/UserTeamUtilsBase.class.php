<?php


class UserTeamUtilsBase {
    
    static function getFieldValuesForSelect($name,$site=null)
    {
        $values=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".UserTeam::getKeyName()." FROM ".UserTeam::getTable().
                           " ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[UserTeam::getKeyName()]]=strtoupper($value[$name]);
        }      
        return $values;
    }
    
    static function getTeamsWithConditionsForSelect(ConditionsQuery $where,$site=null)
    {
        $values=array();         
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().
                           " LEFT JOIN ".UserTeamUsers::getInnerForJoin('team_id').
                           " LEFT JOIN ".UserTeamUsers::getOuterForJoin('user_id').
                           $where->getWhere().
                           " GROUP BY ".UserTeam::getTableField('id').
                           " ORDER BY ".UserTeam::getTableField('name')." ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('UserTeam'))
        { 
            $values[$item->get('id')]=strtoupper($item->get('name'));
        }      
        return $values;
    }
    
 
     
      function isTeamsExists($list,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT name FROM ".UserTeam::getTable().                      
                       " WHERE ".UserTeam::getTableField('name')." IN('".implode("','",$list)."')".
                       ";")               
            ->makeSiteSqlQuery($site);   
        if (!$db->getNumRows())
            return $list;
        $unknown=$list;    
        while ($row=$db->fetchArray())
        {          
            if (($key=array_search($row['name'],$list))!==false)
            {
                unset($unknown[$key]);
            }                   
        }  
        return $unknown;   
    }
    
    function setTeamsForUserImport(User $user,$list)
    {
        if ($user->isNotLoaded())
           return ;        
        // Find unknown categories
        $unKnown=self::isTeamsExists($list,$user->getSite());       
        // take only existing object1 not yet linked with object2
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('user_id'=>$user->get('id')))
            ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('team_id').
                            " AND ".UserTeamUsers::getTableField('user_id')."={user_id}".
                       " WHERE ".UserTeamUsers::getTableField('id')." IS NULL".                    
                       " AND ".UserTeam::getTableField('name')." IN('".implode("','",$list)."')".
                       ";")               
            ->makeSiteSqlQuery($user->getSite());  
        if (!$db->getNumRows())
            return $unKnown;
        $collection=new UserTeamUsersCollection(null,$user->getSite());
        while ($item=$db->fetchObject('UserTeam'))
        {               
            $join=new UserTeamUsers(null,$user->getSite());
            $join->add(array('user_id'=>$user,'team_id'=>$item));
            $collection[]=$join;
        }
        $collection->save();           
        return $unKnown;
    }
    
    
    static function getUsersByIdFromTeams($teams,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT ".User::getTableField('id')." FROM ".User::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').                           
                       " WHERE team_id IN('".implode("','",$teams)."');".
                       ";")               
            ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return array();
        $users=array();
         while ($row=$db->fetchArray())
        {          
            $users[]=$row['id'];                
        }  
        return $users;   
    }    
    
     protected static function hasNoTeamInRange($teams)
    {
        foreach ($teams as $team)
        {
            if ($team=='IS_NULL')
                return true;
        }    
        return false;
    }  
    
    static function getTeleproUsersByIdFromTeams($teams,$site=null)
    {
       if (self::hasNoTeamInRange($teams))
       {
           $conditions_team=" (team_id IN('".implode("','",$teams)."')  OR team_id IS NULL ) ";
       }   
       else
       {
           $conditions_team="team_id IN('".implode("','",$teams)."') ";
       }    
        
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT ".User::getTableField('id')." FROM ".User::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').  
                       " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                       " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                       " WHERE ".
                            $conditions_team.
                            " AND ".UserFunction::getTableField('name')."='TELEPRO'".
                       " GROUP BY ".User::getTableField('id').
                       ";")               
            ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return array();
        $users=array();
         while ($row=$db->fetchArray())
        {          
            $users[]=$row['id'];                
        }  
        return $users;   
    }    
    
    static function getSalesUsersByIdFromTeams($teams,$site=null)
    {
       $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT ".User::getTableField('id')." FROM ".User::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').  
                       " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                       " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                       " WHERE team_id IN('".implode("','",$teams)."') ".
                            " AND ".UserFunction::getTableField('name')."='SALES'".
                       " GROUP BY ".User::getTableField('id').
                       ";")               
            ->makeSiteSqlQuery($site);  
        if (!$db->getNumRows())
            return array();
        $users=array();
         while ($row=$db->fetchArray())
        {          
            $users[]=$row['id'];                
        }  
        return $users;   
    }    
    
    static function removeDuplicate($site=null)
    {
         // Remove double
        $db=mfSiteDatabase::getInstance()                      
            ->setQuery(" DELETE ".UserTeamUsers::getTable().
                       " FROM ".UserTeamUsers::getTable().
                       " LEFT OUTER JOIN ( ".
                                " SELECT MIN(id) as id, user_id,team_id".
                                " FROM ".UserTeamUsers::getTable().
                                " GROUP BY user_id,team_id ".
                        " ) AS table_1".
                        " ON ".UserTeamUsers::getTableField('id')." = table_1.id".
                        " WHERE table_1.id IS NULL;")
            ->makeSiteSqlQuery($site);  
    }    
    
    static function getTeamsForSelect($site=null)
    {
        $items=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".UserTeam::getTable()." ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $items;
        while ($item=$db->fetchObject('UserTeam'))
        { 
            $item->setSite($site);
            $items[$item->get('id')]=$item->loaded();
        }      
        return $items;
    }        
    
    
    static function getTeamFromUser(User $user)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->get('id')))
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeamUsers::getTable().
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " WHERE user_id='{user_id}'".
                           " LIMIT 0,1".
                           ";")               
                ->makeSiteSqlQuery($user->getSite()); 
        if (!$db->getNumRows())
            return null;
       return $db->fetchObject('UserTeam')->loaded();   
    }
    
    
    function getTeleproUsersWithNoTeam($site=null)
    {        
        $db=mfSiteDatabase::getInstance()                      
            ->setQuery("SELECT ".User::getTableField('id')." FROM ".User::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').  
                       " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                       " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                       " WHERE team_id IS NULL".
                            " AND ".UserFunction::getTableField('name')."='TELEPRO'".
                       " GROUP BY ".User::getTableField('id').
                       ";")               
            ->makeSiteSqlQuery($site);
      //  var_dump($db->getQuery());
        if (!$db->getNumRows())
            return array();
        $users=array();
         while ($row=$db->fetchArray())
        {          
            $users[]=$row['id'];                
        }  
        return $users;   
    }
    
    function getTeleproUsersByIdFromTeam($team,$site=null)
    {                    
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('team_id'=>$team))
            ->setQuery("SELECT ".User::getTableField('id')." FROM ".User::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').  
                       " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                       " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                       " WHERE team_id ".($team=='IS_NULL'?" IS NULL":"='{team_id}'").
                            " AND ".UserFunction::getTableField('name')."='TELEPRO'".
                       " GROUP BY ".User::getTableField('id').
                       ";")               
            ->makeSiteSqlQuery($site);         
        if (!$db->getNumRows())
            return array();
        $users=array();
         while ($row=$db->fetchArray())
        {          
            $users[]=$row['id'];                
        }  
      //  var_dump($users);
        return $users;  
    }   
    
    static function getManagersForSelect($site=null)
    {
        $users=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().  
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('user_id').  
                           " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".                        
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;  
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('firstname')." ".$user->get('lastname'));
        }
        return $users;
    } 
    
    
     static function getManagersAndTeamsFromPager(Pager $pager)
    {
         
        $users=new mfArray($pager->getKeys());        
        // Get managers
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('User'))
                ->setQuery("SELECT {fields},".UserTeamUsers::getTableField('user_id')." as user_id FROM ".UserTeam::getTable().  
                           " LEFT JOIN ".UserTeamUsers::getInnerForJoin('team_id').                             
                           " INNER JOIN ".UserTeam::getOuterForJoin('manager_id').
                           " WHERE ".UserTeamUsers::getTableField('user_id')." IN('".$users->implode("','")."')".
                       //    " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".                        
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
         if (!$db->getNumRows())
             return ;
         $managers=new mfArray();
         while ($items=$db->fetchObjects())
        {       
            $user=$items->getUser();
            if (!isset($pager[$items->get('user_id')]))
                continue;           
            $pager[$items->get('user_id')]->addManager($user);   
            if (isset($managers[$user->get('id')]))
                continue;
            $managers[$user->get('id')]=$pager[$items->get('user_id')]->getTeamManagers()->getItemByKey($user->get('id'));
          //  $pager[$items->get('user_id')]->getTeamManagers()->getItemByKey($user->get('id'))->addTeam($items->getUserTeam());
        }   
       // var_dump($managers->getKeys());
         $db=mfSiteDatabase::getInstance()
                ->setParameters()                
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().                            
                           " WHERE ".UserTeam::getTableField('manager_id')." IN('".$managers->getKeys()->implode("','")."')".                        
                           " ORDER BY ".UserTeam::getTableField('name')." COLLATE UTF8_GENERAL_CI ASC".                        
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
      //   echo $db->getQuery();
         if (!$db->getNumRows())
             return ;
        while ($item=$db->fetchObject('UserTeam'))
        {            
            //echo $item->get('manager_id')."<br/>";
            foreach ($pager as $user)
            {
                if (!$user->hasTeamManagers())
                    continue;
                if (!$user->getTeamManagers()->hasItemByKey($item->get('manager_id'))) 
                    continue;                
                $user->getTeamManagers()->getItemByKey($item->get('manager_id'))->addTeam($item->loaded());
            }   
        }     
    }
    
     static function getTeamsWithDefaultTeamForSelect($site=null)
    {
        $settings= new UserSettings(null,$site);
        $values=new mfArray();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT DISTINCT(name),".UserTeam::getKeyName()." FROM ".UserTeam::getTable().
                           " ORDER BY name ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[UserTeam::getKeyName()]]=mb_strtoupper($value['name']);
        }      
        if ($settings->hasDefaultTeam())
        {    
            $default=$settings->getDefaultTeam();
            $values[$default->get('id')]=mb_strtoupper($default->get('name'));
        }
        $values->asort();
        return $values;
    }
    
    static function getFieldValues2ForSelect($name,$site=null)
    {
        $values=new mfArray();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT DISTINCT({name}),".UserTeam::getKeyName()." FROM ".UserTeam::getTable().
                           " ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($value=$db->fetchArray())
        { 
            $values[$value[UserTeam::getKeyName()]]=strtoupper($value[$name]);
        }      
        return $values;
    }
    
    static function getFieldValuesForSelect2($name,$site=null)
    {
        $values=new mfArray();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("name"=>$name))
                ->setQuery("SELECT * FROM ".UserTeam::getTable().       
                           " GROUP BY {name}".
                           " ORDER BY {name} ASC;")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('UserTeam'))
        { 
            $values[$item->get('id')]=$item;
        }      
        return $values;
    }
    
    static function getTeamsForPager($pager)
    {
         if (!$pager->hasItems())
             return ;                
         $db=mfSiteDatabase::getInstance();
           $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))  
                ->setQuery("SELECT user_id ,GROUP_CONCAT(".UserTeam::getTableField('name')." ORDER BY ".UserTeam::getTableField('name')." ASC) as teams ".
                                " FROM ".UserTeamUsers::getTable().
                            " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id'). 
                            " WHERE ".UserTeamUsers::getTableField('user_id')." IN('".mfArray::create($pager->getKeys())->implode("','")."')".
                            " GROUP BY user_id".
                            ";")          
                ->makeSiteSqlQuery($pager->getSite()); 
       //  echo $db->getQuery();
         if (!$db->getNumRows())
            return ;
        while ($row=$db->fetchArray())
        { 
            if (!isset($pager[$row['user_id']]))
                continue;            
           $pager[$row['user_id']]->teams=$row['teams'];
        }                      
    }
}
