<?php

class UserProfileBase extends mfObject2 {
     
    const table="t_users_profile"; 
    protected static $fields=array('name','created_at','updated_at');  
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);        
      }   
    }

    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");    
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable().
                    " WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   
    }
    
  
      
    function hasI18n($lang=null)
    {
        return (boolean)$this->getI18n($lang);
    }
    
    function setI18n($i18n)
    {
        $this->i18n=$i18n;
        return $this;
    }
    
    function getI18n($lang=null)
    {
        if ($this->i18n===null)
        {
            if ($lang==null)
                $lang=mfContext::getInstance()->getUser()->getCountry();
            $this->i18n=new UserProfileI18n(array('lang'=>$lang,'profile_id'=>$this->get('id')),$this->getSite());
        }    
        return $this->i18n;
    }   
    
    
    function getUsers()
    {
        if ($this->users === null)
        {
            $this->users=new UserCollection(null,'admin',$this->getSite()); 
            if ($this->isNotLoaded())
                return $this->users;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("SELECT ".User::getFieldsAndKeyWithTable().
                            " FROM ".UserProfiles::getTable().
                            " INNER JOIN ".UserProfiles::getOuterForJoin('user_id').
                            " WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->site);   
            if (!$db->getNumRows())
                return $this->users;
            while ($item=$db->fetchObject('User'))
            {                                                  
               $this->users[$item->get('id')]=$item->loaded() ;
            }     
            $this->users->loaded();
        }   
        return $this->users;
    }
    
    
    function getFunctions()
    {
        if ($this->functions === null)
        {
            $this->functions=new UserProfileFunctionCollection(null,$this->getSite()); 
            if ($this->isNotLoaded())
                return $this->functions;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".UserProfileFunction::getTable()." WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->site);   
            if (!$db->getNumRows())
                return $this->functions;
            while ($item=$db->fetchObject('UserProfileFunction'))
            {                                                  
               $this->functions[$item->get('function_id')]=$item->loaded() ;
            }     
            $this->functions->loaded();
        }   
        return $this->functions;
    }
    
     function getGroups()
    {
        if ($this->groups === null)
        {
            $this->groups=new UserProfileGroupCollection(null,$this->getSite()); 
            if ($this->isNotLoaded())
                return $this->groups;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".UserProfileGroup::getTable()." WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->getSite());   
            if (!$db->getNumRows())
                return $this->groups;
            while ($item=$db->fetchObject('UserProfileGroup'))
            {                                                  
               $this->groups[$item->get('group_id')]=$item->loaded()->setSite($this->getSite()) ;
            }     
            $this->groups->loaded();
        }   
        return $this->groups;
    }
    
    
    public function updateFunctions(mfArray $functions)
    {      
        if ($this->isNotLoaded())
            return $this;        
        $db=mfSiteDatabase::getInstance();
        if ($functions->isEmpty())
        {
            $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("DELETE FROM ".UserProfileFunction::getTable()." WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->site);
            return ;
        }               
        // Remove not used functions
        $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("DELETE FROM ".UserProfileFunction::getTable()." WHERE profile_id={profile_id} AND function_id NOT IN(".$functions->implode(",").");")
                 ->makeSiteSqlQuery($this->site);          
        // get existing 
        $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("SELECT function_id FROM ".UserProfileFunction::getTable()." WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->site);              
        if ($db->getNumRows())
        {      
            while ($row=$db->fetchRow())
            {                                                  
               $functions->findAndRemove($row[0]);         
            }      
        }                   
        // Add new user functions    
        $collection=new UserProfileFunctionCollection(null,$this->getSite());  
        foreach ($functions as $id)
        {
            $item= new UserProfileFunction(null,$this->getSite());
            $item->add(array('profile_id'=>$this,'function_id'=>$id));
            $collection[]=$item;
        }        
        $collection->save();
        
        // Remove function not in
      /*  $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("DELETE ".UserFunctions::getTable()." FROM ".UserFunctions::getTable().
                           " INNER JOIN ".UserProfileFunction::getInnerForJoin('function_id').
                           " WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->site); */
        // add function for each 
        $this->updateFunctionsForUsers();
    } 
    
    public function updateGroups(mfArray $groups)
    {               
        if ($this->isNotLoaded())
            return $this;     
        $db=mfSiteDatabase::getInstance();
        if ($groups->isEmpty())
        {
            $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("DELETE FROM ".UserProfileGroup::getTable()." WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->site);
            return ;
        }    
            
            // Remove not used groups
            $db->setParameters(array('profile_id'=>$this->get('id')))
                     ->setQuery("DELETE FROM ".UserProfileGroup::getTable()." WHERE profile_id={profile_id} AND group_id NOT IN(".$groups->implode(",").");")
                     ->makeSiteSqlQuery($this->site);
       
        // get existing 
        $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("SELECT group_id FROM ".UserProfileGroup::getTable()." WHERE profile_id={profile_id};")
                 ->makeSiteSqlQuery($this->site);       
        if ($db->getNumRows())
        {      
            while ($row=$db->fetchRow())
            {                                                  
               $groups->findAndRemove($row[0]);         
            }     
        }         
        // Add new user groups        
        $collection=new UserProfileGroupCollection(null,$this->getSite());  
        foreach ($groups as $id)
        {
            $item= new UserProfileGroup(null,$this->getSite());
            $item->add(array('profile_id'=>$this,'group_id'=>$id,'is_active'=>'YES'));
            $collection[]=$item;
        }    
        $collection->save();
         $this->updateGroupsForUsers();
    } 
    
    function updateFunctionsAndGroups(mfArray $functions,mfArray $groups)
    {
        $this->updateFunctions($functions);
        $this->updateGroups($groups);                        
        return $this;
    }
    
    
    static function getProfilesI18nForSelect($site=null)
    {
        $values=new mfArray(); 
        $db=mfSiteDatabase::getInstance()
                  ->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))
                 ->setQuery("SELECT value,profile_id FROM ".UserProfileI18n::getTable().
                            " WHERE lang='{lang}'".
                            " ORDER BY value ASC".
                            ";")
                 ->makeSiteSqlQuery($site);       
        if (!$db->getNumRows())
             return $values;      
        while ($row=$db->fetchArray())
        {                                                  
           $values[$row['profile_id']]=$row['value'];
        }            
        return $values;
    }
    
    /*
     * SELECT t_users.id,t_users_profile_function.function_id FROM t_users
INNER JOIN t_users_profiles ON t_users_profiles.user_id=t_users.id
INNER JOIN t_users_profile_function ON t_users_profile_function.profile_id=t_users_profiles.profile_id
LEFT JOIN t_users_functions ON t_users_functions.function_id=t_users_profile_function.function_id AND t_users_functions.user_id=t_users.id
WHERE t_users_profiles.profile_id='20' AND t_users_functions.id IS NULL
     */
    
   /*
    DELETE t_users_functions FROM t_users_functions
INNER JOIN t_users_profiles ON t_users_profiles.user_id=t_users_functions.user_id 
LEFT JOIN t_users_profile_function ON t_users_profile_function.function_id=t_users_functions.function_id   
WHERE t_users_profile_function.id IS NULL  AND t_users_profiles.profile_id='20'
    */

    function updateFunctionsForUsers()
    {                         
        $functions=$this->getFunctions()->getFunctions();
        $db=mfSiteDatabase::getInstance();
                 $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("DELETE ".UserFunctions::getTable()." FROM ".UserFunctions::getTable().
                            " INNER JOIN ".UserProfiles::getTable()." ON ".UserProfiles::getTableField('user_id')."=".UserFunctions::getTableField('user_id').
                            " LEFT JOIN ".UserProfileFunction::getTable()." ON ".UserProfileFunction::getTableField('function_id')."=".UserFunctions::getTableField('function_id').
                            " WHERE ".UserProfiles::getTableField('profile_id')."='{profile_id}' AND ".UserProfileFunction::getTableField('id')." IS NULL".
                            ";") 
                 ->makeSiteSqlQuery($this->getSite());                 
        
       //       echo $db->getQuery();
        
        // add functions        
         $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("SELECT ".User::getTableField('id').",".UserProfileFunction::getTableField('function_id')."  FROM ".User::getTable().
                            " INNER JOIN ".UserProfiles::getInnerForJoin('user_id'). 
                            " INNER JOIN ".UserProfileFunction::getTable()." ON " .UserProfileFunction::getTableField('profile_id')."=". UserProfiles::getTaBleField('profile_id').                                                            
                            " LEFT JOIN ".UserFunctions::getTable()." ON ". UserFunctions::getTableField('function_id')."=".UserProfileFunction::getTableField('function_id')." AND ".UserFunctions::getTableField('user_id')."=".User::getTableField('id').                                                                                                                             
                            " WHERE ".UserProfiles::getTableField('profile_id')."='{profile_id}' AND ".UserFunctions::getTableField('id')." IS NULL ".
                            ";")
                 ->makeSiteSqlQuery($this->getSite());             
        if (!$db->getNumRows())
             return ;      
        $user_functions=new UserFunctionsCollection(null,$this->getSite());
        while ($row=$db->fetchArray())
        {
            $item=new UserFunctions(null,$this->getSite());
            $item->add(array('user_id'=>$row['id'],'function_id'=>$row['function_id']));
            $user_functions[]=$item;
        }       
        $user_functions->save();
        return $this;
    }
    
    function updateGroupsForUsers()
    {                    
        $groups=$this->getGroups()->getGroups();
        $db=mfSiteDatabase::getInstance();
        // remove groups not used
       $db=mfSiteDatabase::getInstance();
                 $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("DELETE ".UserGroup::getTable()." FROM ".UserGroup::getTable().
                            " INNER JOIN ".UserProfiles::getTable()." ON ".UserProfiles::getTableField('user_id')."=".UserGroup::getTableField('user_id').
                            " LEFT JOIN ".UserProfileGroup::getTable()." ON ".UserProfileGroup::getTableField('group_id')."=".UserGroup::getTableField('group_id').
                            " WHERE ".UserProfiles::getTableField('profile_id')."='{profile_id}' AND ".UserProfileGroup::getTableField('id')." IS NULL".
                            ";") 
                 ->makeSiteSqlQuery($this->getSite());    
       // echo $db->getQuery();
        // add groups 
      
         $db->setParameters(array('profile_id'=>$this->get('id')))
                 ->setQuery("SELECT ".User::getTableField('id').",".UserProfileGroup::getTableField('group_id')."  FROM ".User::getTable().
                            " INNER JOIN ".UserProfiles::getInnerForJoin('user_id'). 
                            " INNER JOIN ".UserProfileGroup::getTable()." ON " .UserProfileGroup::getTableField('profile_id')."=". UserProfiles::getTaBleField('profile_id').                                                            
                            " LEFT JOIN ".UserGroup::getTable()." ON ". UserGroup::getTableField('group_id')."=".UserProfileGroup::getTableField('group_id')." AND ".UserGroup::getTableField('user_id')."=".User::getTableField('id').                                                                                                                             
                            " WHERE ".UserProfiles::getTableField('profile_id')."='{profile_id}' AND ".UserGroup::getTableField('id')." IS NULL ".
                            ";")
                 ->makeSiteSqlQuery($this->getSite());      
      //  echo $db->getQuery();
        if (!$db->getNumRows())
             return ;      
        $user_groups=new UserGroupCollection(null,$this->getSite());
        while ($row=$db->fetchArray())
        {         
            $item=new UserGroup(null,$this->getSite());
            $item->add(array('user_id'=>$row['id'],'is_active'=>'YES','group_id'=>$row['group_id']));
            $user_groups[]=$item;
        }       
        $user_groups->save();
        return $this;
    }
    
    
    
     static function getProfilesFromSelectionForSelect(mfArray $selection,$site=null)
    {                
        $values=new mfArray(); 
        $db=mfSiteDatabase::getInstance()
                  ->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))
                 ->setQuery("SELECT value,profile_id FROM ".UserProfileI18n::getTable().                            
                            " WHERE lang='{lang}' AND profile_id IN('".$selection->implode("','")."')".         
                            " ORDER BY value ASC".
                            ";")
                 ->makeSiteSqlQuery($site);       
        if (!$db->getNumRows())
             return $values;      
        while ($row=$db->fetchArray())
        {                                                  
           $values[$row['profile_id']]=$row['value'];
        }            
        return $values;
    }
    
    static function getProfilesFromSelection(mfArray $selection,$site=null)
    {                
        $values=new mfArray(); 
        $db=mfSiteDatabase::getInstance()
                  ->setParameters(array())
                 ->setQuery("SELECT * FROM ".UserProfile::getTable().                            
                            " WHERE id IN('".$selection->implode("','")."')".                                  
                            ";")
                 ->makeSiteSqlQuery($site);       
        if (!$db->getNumRows())
             return $values;      
        while ($item=$db->fetchObject('UserProfile'))
        {                                                  
           $values[$item->get('id')]=$item->loaded();
        }            
        return $values;
    }
        
    
    function moveTo(UserProfile $profile)
    {
        if ($this->isNotLoaded() || $profile->isNotLoaded())
            return $this;
        $profile_function=new UserProfileFunction($profile,$this->getSite());
        if ($profile_function->isNotLoaded())
            return $this;
         $profile_group=new UserProfileGroup($profile,$this->getSite());
        if ($profile_group->isNotLoaded())
            return $this;       
       // echo "New group=".$group->get('id')."<br/>";
      //  echo "New function=".$function->get('id')."<br/>";
      
        // UserFunctions
         $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$this->get('id'),'new_function_id'=>$profile_function->get('function_id')))
                 ->setQuery("UPDATE ".UserFunctions::getTable().  
                            " INNER JOIN ".UserProfileFunction::getTable()." ON ".UserProfileFunction::getTableField('function_id')."=".UserFunctions::getTableField('function_id').
                            " SET ".UserFunctions::getTableField('function_id')."='{new_function_id}'".
                            " WHERE profile_id='{profile_id}'".                                  
                            ";")
                 ->makeSiteSqlQuery($this->getSite());  
          // echo $db->getQuery();  
        // UserGroup
          $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$this->get('id'),'new_group_id'=>$profile_group->get('group_id')))
                 ->setQuery("UPDATE ".UserGroup::getTable().  
                            " INNER JOIN ".UserProfileGroup::getTable()." ON ".UserProfileGroup::getTableField('group_id')."=".UserGroup::getTableField('group_id').
                            " SET ".UserGroup::getTableField('group_id')."='{new_group_id}'".
                            " WHERE profile_id='{profile_id}'".                                  
                            ";")
                 ->makeSiteSqlQuery($this->getSite());  
         
         // UserProfiles
         $db=mfSiteDatabase::getInstance()
                  ->setParameters(array('profile_id'=>$this->get('id'),'new_profile_id'=>$profile->get('id')))
                 ->setQuery("UPDATE ".UserProfiles::getTable().   
                            " SET profile_id='{new_profile_id}'".
                            " WHERE profile_id='{profile_id}'".                                  
                            ";")
                 ->makeSiteSqlQuery($this->getSite());  
        return $this;
    }      
    
    function getFunctionsAndGroupsWithPermissionsForProfile()
    {
        if ($this->_groups === null)
        {
            $this->_groups=new GroupCollection(null, $this->getSite()); 
            if ($this->isNotLoaded())
                return $this->_groups;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$this->get('id')))
                 ->setObjects(array('UserProfile','Group','Permission','UserFunction','UserFunctionI18n'))
                 ->setQuery("SELECT {fields} FROM ".UserProfile::getTable().
                         " INNER JOIN ". UserProfileGroup::getInnerForJoin('profile_id'). 
                         " INNER JOIN ".GroupPermission::getTable()." ON ".UserProfileGroup::getTableField('group_id')."=".GroupPermission::getTableField('group_id').
                         " INNER JOIN ". UserProfileGroup::getOuterForJoin('group_id'). 
                         " INNER JOIN ". GroupPermission::getOuterForJoin('permission_id'). 
                         " INNER JOIN ". UserProfileFunction::getInnerForJoin('profile_id'). 
                         " INNER JOIN ". UserProfileFunction::getOuterForJoin('function_id'). 
                         " INNER JOIN ". UserFunctionI18n::getInnerForJoin('function_id'). 
                         " WHERE ".UserProfileGroup::getTableField('profile_id')."={profile_id}".
                         " GROUP BY ".Permission::getTableField('name').",".Group::getTableField('name').",".UserFunction::getTableField('name').
                         " ORDER BY ".Permission::getTableField('name')." ASC ;")
                 ->makeSiteSqlQuery($this->getSite());   
                //echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->_groups;
          
            while ($items=$db->fetchObjects())
            {                 
                if(!isset($this->_groups[$items->getGroup()->get('id')])){
                    $this->_groups[$items->getGroup()->get('id')]=$items->getGroup()->loaded()->setSite($this->getSite()) ;
                    $this->_groups[$items->getGroup()->get('id')]->profile=$items->getUserProfile()->loaded()->setSite($this->getSite()) ;
                }
               $this->_groups[$items->getGroup()->get('id')]->getPermissionsList()->push($items->getPermission());                        
               $this->getFunctionsList()->push($items->getUserFunction()->setI18n($items->getUserFunctionI18n()));
            }     
            $this->_groups->loaded();
        }
        return $this->_groups;
    }
    
    function getFunctionsList(){
        
        if ($this->_functions===null)
        {
           $this->_functions=new UserFunctionCollection(null,$this->getSite());
        }
        return $this->_functions;
        
    }
    
     function getNumberOfUsersAffected()
    {
        return $this->number_of_users_affected;
    }
    
    function affectTo(UserProfile $profile)
    {
        
        if (!$profile || $profile->isNotLoaded())
            return $this;         
        // Supprime toutes les functions des users
         $db=new mfSiteDatabase();
         $db->setParameters(array('profile_id'=>$this->get('id')))
                    ->setQuery("DELETE FROM ".UserFunctions::getTable().                                                                                              
                               " WHERE " .UserFunctions::getTableField('user_id')." IN('".$this->getUsers()->getKeys()->implode("','")."')".                              
                               ";")
                    ->makeSiteSqlQuery($this->getSite());         
        // Supprime users des profiles
         $db->setParameters(array('profile_id'=>$this->get('id')))
                    ->setQuery("DELETE  FROM ".UserProfiles::getTable().                                                                                              
                               " WHERE " .UserProfiles::getTableField('user_id')." IN('".$this->getUsers()->getKeys()->implode("','")."')".  
                               " AND ".UserProfiles::getTableField('profile_id')."='{profile_id}'".
                               ";")
                    ->makeSiteSqlQuery($this->getSite());  
         // users / groups
          $db->setParameters(array('profile_id'=>$this->get('id')))
                    ->setQuery("DELETE FROM ".UserGroup::getTable().                                                                                              
                               " WHERE " .UserGroup::getTableField('user_id')." IN('".$this->getUsers()->getKeys()->implode("','")."')".                              
                               ";")
                    ->makeSiteSqlQuery($this->getSite());  
              
        // Users / Function 
        $user_function_collection = new UserFunctionsCollection(null,$this->getSite());
        foreach ($this->getUsers() as $user)
        {
            foreach ($profile->getFunctions()->getKeys() as $function_id)
            {
                $item=new UserFunctions(null,$this->getSIte());
                $item->add(array('user_id'=>$user,'function_id'=>$function_id));
                $user_function_collection[]=$item;
            }    
        }
        $user_function_collection->save();
        
        // Users / Group
        $user_group_collection = new UserGroupCollection(null,$this->getSite());
        foreach ($this->getUsers() as $user)
        {
            foreach ($profile->getGroups()->getKeys() as $group_id)
            {
                $item=new UserGroup(null,$this->getSIte());
                $item->add(array('user_id'=>$user,'group_id'=>$group_id,'is_active'=>"YES"));
                $user_group_collection[]=$item;
            }
        }
        $user_group_collection->save();
        // Users / Profile
        $user_profile_collection = new UserProfilesCollection(null,$this->getSite());    
        foreach ($this->getUsers() as $user)
        {
            $item=new UserProfiles(null,$this->getSIte());
            $item->add(array('user_id'=>$user,'profile_id'=>$profile));
            $user_profile_collection[]=$item;
        }
        $user_profile_collection->save();
        
        $this->number_of_users_affected=$this->getUsers()->count();
        
        return $this;
    }
    
            
    static function updateProfileForMultipleUsers(UserProfile $profile,$selection,$site=null)
    {              
        if ($profile->isNotLoaded())
            return $this;
        $messages=new mfArray();
        if ($selection->isEmpty())
             return $messages->push(__("No selection"));
        //Delete all existing users profiles
            $db= mfSiteDatabase::getInstance();
            $db->setParameters()
                    ->setQuery(
                            "DELETE FROM ".UserProfiles::getTable().
                            " WHERE ".UserProfiles::getTableField('user_id')." IN('".$selection->implode("','")."')". 
                            ";"
                            )
                    ->makeSiteSqlQuery($site);
        //Delete all existing users functions 
            $db= mfSiteDatabase::getInstance();
            $db->setParameters()
                    ->setQuery(
                            "DELETE FROM ".UserFunctions::getTable().
                            " WHERE ".UserFunctions::getTableField('user_id')." IN('".$selection->implode("','")."')". 
                            ";"
                            )
                    ->makeSiteSqlQuery($site);
        //Delete all existing users groups 
            $db= mfSiteDatabase::getInstance();
            $db->setParameters()
                    ->setQuery(
                            "DELETE FROM ". UserGroup::getTable().
                            " WHERE ".UserGroup::getTableField('user_id')." IN('".$selection->implode("','")."')". 
                            ";"
                            )
                    ->makeSiteSqlQuery($site);
            
        //Change the old profile to the new one 
         
         // Users / Function 
        $user_function_collection = new UserFunctionsCollection(null,$site);
        foreach ($selection as $user)
        {
            foreach ($profile->getFunctions()->getKeys() as $function_id)
            {
                $item=new UserFunctions(null,$site);
                $item->add(array('user_id'=>$user,'function_id'=>$function_id));
                $user_function_collection[]=$item;
            }    
        }
        $user_function_collection->save();
        
        // Users / Group
        $user_group_collection = new UserGroupCollection(null,$site);
        foreach ($selection as $user)
        {
            foreach ($profile->getGroups()->getKeys() as $group_id)
            {
                $item=new UserGroup(null,$site);
                $item->add(array('user_id'=>$user,'group_id'=>$group_id,'is_active'=>"YES"));
                $user_group_collection[]=$item;
            }
        }
        $user_group_collection->save();
        // Users / Profile
        $user_profile_collection = new UserProfilesCollection(null,$site);    
        foreach ($selection as $user)
        {
            $item=new UserProfiles(null,$site);
            $item->add(array('user_id'=>$user,'profile_id'=>$profile));
            $user_profile_collection[]=$item;
        }
        $user_profile_collection->save();
            
        $messages->push(__('Profiles has been changed.'));
        
        return $messages;
    }
    
    
   function getPermissions()
    {
        if ($this->permissions===null)
        {    
           $this->permissions= new mfArray();
            if ($this->isNotLoaded())
                return $this->permissions;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$this->get('id')))                 
                 ->setQuery("SELECT ".Permission::getFieldsAndKeyWithTable()." FROM ".UserProfile::getTable().
                         " INNER JOIN ". UserProfileGroup::getInnerForJoin('profile_id'). 
                         " INNER JOIN ".GroupPermission::getTable()." ON ".UserProfileGroup::getTableField('group_id')."=".GroupPermission::getTableField('group_id'). 
                         " INNER JOIN ". UserProfileGroup::getOuterForJoin('group_id'). 
                         " INNER JOIN ". GroupPermission::getOuterForJoin('permission_id'). 
                         " WHERE ".UserProfileGroup::getTableField('profile_id')."={profile_id} ".
                                   " AND ".Permission::getTableField('application')."='admin'".
                          " ;")
                 ->makeSiteSqlQuery($this->getSite());   
            //     echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->permissions;
          
            while ($item=$db->fetchObject('Permission'))
            {                                  
               $this->permissions[$item->get('id')]=$item->loaded();            
            }              
        }
        return $this->permissions;
    }
    
    
    function getUserGroups()
    {
        return $this->user_groups=$this->user_groups===null?new UserGroupCollection($this):$this->user_groups;
    }
    
  
}
