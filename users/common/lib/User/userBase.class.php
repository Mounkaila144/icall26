<?php

class UserBase extends mfObject2 {
     
    protected static $fields=array('firstname','lastname','email','password','lastlogin','last_password_gen','username', 
                                   'mobile','callcenter_id','status',
                                   'is_locked', 'locked_at', 'unlocked_by','number_of_try', //SECURITY    
                                   'creator_id',
                                   'is_secure_by_code','company_id',
                                   'application','is_active','is_guess','created_at','updated_at','picture','sex','email_tosend');
    const table="t_users"; 
    protected $permissions=array(),$permission_names=array();
   protected static $foreignKeys=array(  'callcenter_id'=>'Callcenter',
                                         'unlocked_by'=>'User',
                                         'creator_id'=>'User',
                                        'company_id'=>'CustomerContractCompany',
                                        ); // By default
    protected static $fieldsNull=array('lastlogin','last_password_gen','locked_at', 'unlocked_by','creator_id','company_id');
    
    function __construct($parameters=null,$application=null,$site=null) {
      parent::__construct($application,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['login']))
             return $this->loadByLogin((string)$parameters['login']);
          // Import
          if (isset($parameters['username']) || (isset($parameters['firstname']) && isset($parameters['lastname'])))
              return $this->loadByUsernameOrFirstNameAndLastname((string)$parameters['username'],(string)$parameters['firstname'],(string)$parameters['firstname'],(string)$parameters['lastname']);
          if (isset($parameters['firstname']) && isset($parameters['lastname']))
              return $this->loadByFirstnameAndLastname((string)$parameters['firstname'],(string)$parameters['lastname']);
           if (isset($parameters['name']))
              return $this->loadByName((string)$parameters['name']);
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         return $this->loadByEmail((string)$parameters);
      }   
    }
    
    
    protected function loadByLogin($username)
    {
        $this->set('username',$username);
        $db=mfSiteDatabase::getInstance()->setParameters(array('username'=>$username));
        $db->setQuery("SELECT * FROM ".self::getTable().
                      " WHERE username='{username}'".
                      " AND application@@IN_APPLICATION@@;");
        if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
        else
            $db->makeSqlQuery($this->application,$this->site);                              
        return $this->rowtoObject($db);
    }
    
     protected function loadByUsernameOrFirstNameAndLastname($username,$firstname,$lastname)
    {
         if ($username=='')
             return $this->loadByFirstnameAndLastname($firstname,$lastname);
         $this->set('firstname',$firstname);
         $this->set('lastname',$lastname);
         $this->set('username',$username);
         $db=mfSiteDatabase::getInstance()->setParameters(array('firstname'=>$firstname,'lastname'=>$lastname,'username'=>$username));
         $db->setQuery("SELECT * FROM ".self::getTable().
                       " WHERE (firstname='{firstname}' AND lastname='{lastname}') OR username='{username}'".
                        " AND application@@IN_APPLICATION@@;");
          if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site);                              
         return $this->rowtoObject($db);
    }
    
     protected function loadByFirstnameAndLastname($firstname,$lastname)
    {
         $this->set('firstname',$firstname);
         $this->set('lastname',$lastname);
         $db=mfSiteDatabase::getInstance()->setParameters(array('firstname'=>$firstname,'lastname'=>$lastname));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE firstname='{firstname}' AND lastname='{lastname}' AND application@@IN_APPLICATION@@;");
          if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site); 
         //   ->makeSqlQuery($this->application,$this->site);                           
         return $this->rowtoObject($db);
    }
    
     protected function loadByName($name)
    {         
         $db=mfSiteDatabase::getInstance()->setParameters(array('name'=>$name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE (UPPER(CONCAT(firstname,' ',lastname))=UPPER('{name}') OR UPPER(CONCAT(lastname,' ',firstname))=UPPER('{name}')) AND application@@IN_APPLICATION@@;");
          if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site); 
         //   ->makeSqlQuery($this->application,$this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s' AND application@@IN_APPLICATION@@;");
          if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site); 
         //   ->makeSqlQuery($this->application,$this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {       
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d AND application@@IN_APPLICATION@@;");
         if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site); 
        //    ->makeSqlQuery($this->application,$this->site);         
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->email_tosend=isset($this->email_tosend)?$this->email_tosend:"NO";
       $this->is_active=isset($this->is_active)?$this->is_active:"NO";
       $this->is_guess=isset($this->is_guess)?$this->is_guess:"NO";
       $this->sex=isset($this->sex)?$this->sex:"Mr";
       $this->status=isset($this->status)?$this->status:"ACTIVE"; 
       $this->isProfessional=isset($this->isProfessional)?$this->isProfessional:"NO";
       $this->is_locked=isset($this->is_locked)?$this->is_locked:"NO";
       $this->is_secure_by_code=isset($this->is_secure_by_code)?$this->is_secure_by_code:"NO";
    }
     
    protected function executeInsertQuery($db)
    {
      // $db->makeSqlQuery($this->application,$this->site); 
         if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site); 
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;");
       if ($this->isSuperAdministrator())
           $db->makeSqlQuerySuperAdmin($this->application); 
       else
           $db->makeSqlQuery($this->application,$this->site);        
    }
    
    protected function executeDeleteQuery($db)
    {         
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;");
         if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site);        
    }
    
    protected function executeIsExistQuery($db)    
    {                     
        $db->setParameters(array('username'=>$this->get('username'),
                          'firstname'=> mb_strtoupper($this->get('firstname')),
                          'lastname'=>mb_strtoupper($this->get('lastname')),           
                          'id'=>$this->get('id')));
        
        if ($this->application=='admin')
        {    
            $db->setQuery("SELECT id FROM ".self::getTable().
                          " WHERE (username='{username}' OR (UPPER(firstname)='{firstname}' AND UPPER(lastname)='{lastname}')) ".($this->isLoaded()?"AND id!='{id}'":"").
                          " AND application@@IN_APPLICATION@@".
                          ";");
        }
        else
        {
           $db->setQuery("SELECT id FROM ".self::getTable().
                     " WHERE (username='{username}') ".($this->isLoaded()?"AND id!='{id}'":"").
                     " AND application@@IN_APPLICATION@@".
                     ";"); 
        }    
        if ($this->isSuperAdministrator())
            $db->makeSqlQuerySuperAdmin($this->application); 
         else
            $db->makeSqlQuery($this->application,$this->site);              
    }
    
    function getUpperCaseLastName()
    {
        return mb_strtoupper($this->get('lastname'));
    }
    
     function getUpperCaseFirstName()
    {
        return mb_strtoupper($this->get('firstname'));
    }
    // Permission is UserPermission or GroupPermission
    function addPermission($permission)
    {
       $this->permissions[]=$permission;
    }
    
     function  hasCallcenter()
    {
       return (boolean)$this->get('callcenter_id');      
    }
     
    function getCallcenter()
    {
        if (!$this->_callcenter_id)
        {
            $this->_callcenter_id=new Callcenter($this->get('callcenter_id'),$this->getSite());
        }    
        return $this->_callcenter_id;
    }
       
    function addGroup(Group $group)
    {
        $this->groups[$group->get('id')]=$group;
        return $this;
    }
    
    function hasGroup(Group $group)
    {
        return isset($this->groups[$group->get('id')]);
    }
    
    function enable()
    {
        $this->set('status','ACTIVE');
        $this->save();
        return $this;
    }
    
      function disable()
    {
        $this->set('status','DELETE');
        $this->save();
        return $this;
    }
 /*   function getPermissions()
    {
       return $this->permissions;
    }
   
    public function hasPermission($name)
    {
        return isset($this->permissions[$name]);
    }
 */   
    function getAllPermissionNames()
    {
        if (!$this->permission_names)
        {
           foreach ($this->permissions as $group_or_user_permission)
           {
               $this->permission_names[]=$group_or_user_permission->getPermission()->getName();              
           }    
        }          
        return $this->permission_names;       
    } 
    
  /*  function getAllGroupNames()
    {
        if (!$this->group_names)
        {
            $this->group_names=array();
            foreach ($this->groups as $group)
            {
               $this->group_names[$group->get('id')]=$group->getName(); 
            }    
        }   
        return $this->group_names;
    }*/
    
    // SETTERS
    function setLastLogin($time)
    {
        $this->set('lastlogin',$time);
    } 
    
    // GETTER    
    function getId()
    {
        return $this->id;        
    }
    
    function getLastName($ucfirst=false)
    {
        if ($ucfirst)
            return ucfirst($this->lastname);
        return $this->lastname;
    }
    
    function getFirstName($ucfirst=false)
    {
        if ($ucfirst)
            return ucfirst($this->lastname);
        return $this->firstname;
    }
    
    function getEmail()
    {
        return $this->email;
    }
    
    function getPassword()
    {
        return $this->password;
    }      
    
    function emailToSend()
    {
       $this->set('email_tosend','YES');
       return $this;
    }
    
    function emailSent()
    {
       $this->set('email_tosend','NO');
       return $this;
    }
    
    function getGender()
    {
        return $this->get('sex');
    }
    
    // FOR DISPLAY
    public function __toString()
    {      
       return (string) $this->firstname.' '.$this->lastname;
    }
    
    protected function _getName($reverse=true)
    {
        if ($reverse)
            return (string) $this->firstname.' '.$this->lastname;
        return (string) $this->lastname.' '.$this->firstname;
    }  
    
    function getUpperName($reverse=true)
    {
        return (string) mb_strtoupper($this->getName($reverse));
    }
    
    public function getName($reverse=true,$ucfirst=true)
    {
       if ($ucfirst)
       {    
           if ($reverse)
            return ucfirst($this->firstname)." ".ucfirst($this->lastname);
           else 
            return ucfirst($this->lastname)." ".ucfirst($this->firstname);
       }
        return $this->_getName($reverse);  
    }         

    // User directory data
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/".$this->getApplication()."/data/users/".$this->get('id');
    }
    
    function encryptPassword()
    {     
        if (($this->hasPropertyChanged('password') || $this->isNotLoaded())&& $this->get('password') )
        {                     
            $this->set('clear_password',$this->get('password'));
            $this->set('password',md5($this->get('password')));
        }    
        return $this;
    }
    
    function set($name,$value)
    {
        if ($name=='password' && $value=='')
            return $this;
        return parent::set($name, $value);
    }  
    
    public function isSuperAdministrator()
    {
        return ($this->get('application')=='superadmin');
    }
    
 /*   public function getFunctions()
    {
        if ($this->isNotLoaded())
            return array();
        $functions=array();
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".UserFunctions::getTable()." WHERE user_id={user_id};")
                 ->makeSqlQuery($this->application,$this->site);
         if (!$db->getNumRows())
            return $functions;       
        while ($item=$db->fetchObject('UserFunction'))
        {
           $item->loaded();
           $item->site=$this->getSite();
           $functions[]=$item;
        }
        return $functions;
    }*/
    
    public function getFunctionsId()
    {
        if ($this->isNotLoaded())
            return array();        
        $functions=array();
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("SELECT function_id FROM ".UserFunctions::getTable()." WHERE user_id={user_id};")
                 ->makeSqlQuery($this->application,$this->site);
         if (!$db->getNumRows())
            return $functions;       
        while ($row=$db->fetchArray())
        {                     
           $functions[]=$row['function_id'];
        }     
        return $functions;
    }
    
    public function updateFunctions($functions)
    {      
        if ($this->isNotLoaded())
            return array();
        $db=mfSiteDatabase::getInstance();
        if (empty($functions))
        {
            $db->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("DELETE FROM ".UserFunctions::getTable()." WHERE user_id={user_id};")
                 ->makeSiteSqlQuery($this->site);
            return ;
        }    
        
        if ($functions)
        {    
            // Remove not used functions
            $db->setParameters(array('user_id'=>$this->get('id')))
                     ->setQuery("DELETE FROM ".UserFunctions::getTable()." WHERE user_id={user_id} AND function_id NOT IN(".implode(",",$functions).");")
                     ->makeSiteSqlQuery($this->site);
        }         
        // get existing 
        $db->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".UserFunctions::getTable()." WHERE user_id={user_id};")
                 ->makeSiteSqlQuery($this->site);
        $collection=new UserFunctionsCollection(null,$this->getSite());        
        if ($db->getNumRows())
        {      
            while ($item=$db->fetchObject('UserFunctions'))
            {                      
               $collection[]=$item->loaded();            
               if (($key=array_search($item->get('function_id'),$functions))!==false)
               {                 
                  unset($functions[$key]);               
               }   
            }     
        }                
        // Add new user functions        
        foreach ($functions as $id)
        {
            $item= new UserFunctions(null,$this->getSite());
            $item->add(array('user_id'=>$this,'function_id'=>$id));
            $collection[]=$item;
        }    
        $collection->save();
    } 
    
    public function updateGroups($groups)
    {       
        if ($this->isNotLoaded())
            return array();
        $db=mfSiteDatabase::getInstance();
        if (empty($groups))
        {
            $db->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("DELETE FROM ".UserGroup::getTable()." WHERE user_id={user_id};")
                 ->makeSiteSqlQuery($this->site);
            return ;
        }    
        if ($groups)
        {    
            // Remove not used groups
            $db->setParameters(array('user_id'=>$this->get('id')))
                     ->setQuery("DELETE FROM ".UserGroup::getTable()." WHERE user_id={user_id} AND group_id NOT IN(".implode(",",$groups).");")
                     ->makeSiteSqlQuery($this->site);
        }
        // get existing 
        $db->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".UserGroup::getTable()." WHERE user_id={user_id};")
                 ->makeSiteSqlQuery($this->site);
        $collection=new UserGroupCollection(null,$this->getSite());
        if ($db->getNumRows())
        {      
            while ($item=$db->fetchObject('UserGroup'))
            {                                   
               $collection[]=$item->loaded();
               if (($key=array_search($item->get('group_id'),$groups))!==false)
                  unset($groups[$key]);               
            }     
        }         
        // Add new user groups        
        foreach ($groups as $id)
        {
            $item= new UserGroup(null,'admin',$this->getSite());
            $item->add(array('user_id'=>$this,'group_id'=>$id,'is_active'=>'YES'));
            $collection[]=$item;
        }    
        $collection->save();
    } 
    
    /*
     * SELECT * FROM t_users
INNER JOIN t_users_team_users ON t_users_team_users.user_id=t_users.id
WHERE t_users.application='admin' AND t_users_team_users.team_id IN (SELECT team_id FROM t_users_team_users WHERE user_id=603 GROUP BY team_id)
     GROUP BY t_users.id
     */
    function getUsersOfMyTeams()
    {
          if ($this->users_teams===null)
        {    
            $this->users_teams=new mfArray();
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('user_id').                        
                           " WHERE ".User::getTableField('application')."='admin' AND ".    
                                   UserTeamUsers::getTableField('team_id'). " IN (".
                                   " SELECT team_id FROM ".UserTeamUsers::getTable().
                                   " WHERE user_id='{user_id}'".
                                   " GROUP BY team_id".
                                   ")".
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return $this->users_teams;            
            while ($item=$db->fetchObject('User'))
            {               
               $item->site=$this->getSite();
               $this->users_teams[$item->get('id')]=$item->loaded();
            }            
        }
        return $this->users_teams;
    }
    
    function getTeamUsers()
    {
        if ($this->teams_users===null)
        {    
            $this->teams_users=new mfArray();
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " WHERE ".UserTeam::getTableField('manager_id')."={user_id} OR ".    
                                    UserTeam::getTableField('manager2_id')."={user_id}".
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return $this->teams_users;            
            while ($item=$db->fetchObject('User'))
            {               
               $item->site=$this->getSite();
               $this->teams_users[$item->get('id')]=$item->loaded();
            }            
        }
        return $this->teams_users;
    }
    
    function hasTeams()
    {
        return !$this->getTeams()->isEmpty();
    }
    
       
    
    function getTeams()
    {
        if ($this->teams===null)
        {    
            $this->teams=new UserTeamCollection(null,$this->getSite());
            if ($this->isNotLoaded())
                return $this->teams;
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().
                           " LEFT JOIN ".UserTeamUsers::getInnerForJoin('team_id').
                           " WHERE ".UserTeamUsers::getTableField('user_id')."='{user_id}'".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
         //   echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->teams;            
            while ($item=$db->fetchObject('UserTeam'))
            {               
               $item->site=$this->getSite();
               $this->teams[$item->get('id')]=$item->loaded();
            }            
        }
        return $this->teams;
    }
    
    function hasTeamManagers()
    {        
        if (!$this->team_managers)
            return false;
        return !$this->getTeamManagers()->isEmpty();
    }
    
    function  getTeamManagers()
    {
        if ($this->team_managers===null)
        {    
            $this->team_managers=new UserCollection(null,$this->getSite());
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".UserTeamUsers::getTable().                         
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " INNER JOIN ".UserTeam::getOuterForJoin('manager_id').
                           " WHERE ".UserTeamUsers::getTableField('user_id')."={user_id}".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return $this->team_managers;
            while ($item=$db->fetchObject('User'))
            {
               $this->team_managers[$item->get('id')]=$item->loaded()->setSite($this->getSite()); 
            }                        
        }
        return $this->team_managers;
    }
     
    function hasManagerTeam()
    {
        return (boolean)$this->getManagerTeam();
    }
    
    function getManagerTeam()
    {
        if (!$this->team)
        {    
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('manager_id'=>$this->get('id')))
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().                         
                           " WHERE ".UserTeam::getTableField('manager_id')."={manager_id}".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return null;
            $this->team=$db->fetchObject('UserTeam');                        
            $this->team->site=$this->getSite();
            $this->team->loaded();                        
        }
        return $this->team;
    }
    
    function getFunctions()
    {
        if (!$this->functions)
        {    
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".UserFunction::getFieldsAndKeyWithTable()." FROM ".UserFunction::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('function_id').
                           " WHERE ".UserFunctions::getTableField('user_id')."='{user_id}'".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return array();
            $this->functions=array();
            while ($item=$db->fetchObject('UserFunction'))
            {               
               $item->site=$this->getSite();
               $this->functions[$item->get('id')]=$item->loaded();
            }            
        }
        return $this->functions;
    }
    
    function getFunctionsI18n($lang=null)
    {
        if ($this->isNotLoaded())
            return array();
        if (!$this->functions_i18n)
        {    
            if ($lang==null)
                $lang=mfContext::getInstance()->getUser()->getCountry();
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id'),'lang'=>$lang))
                ->setQuery("SELECT ".UserFunctionI18n::getFieldsAndKeyWithTable()." FROM ".UserFunction::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('function_id').
                           " LEFT JOIN ".UserFunctionI18n::getInnerForJoin('function_id')." AND lang='{lang}'".
                           " WHERE ".UserFunctions::getTableField('user_id')."={user_id}".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return array();
            $this->functions_i18n=array();
            while ($item=$db->fetchObject('UserFunctionI18n'))
            {               
               $item->site=$this->getSite();
               $this->functions_i18n[$item->get('id')]=$item->loaded();
            }            
        }
        return $this->functions_i18n;
    }
   
    function getFormattedFunctionsI18n($separator=',')
    {
        $this->getFunctionsI18n();       
        if (!$this->functions_i18n)
            return "";
        $functions=array();
        foreach ($this->functions_i18n as $function)
            $functions[]=$function->get('value');
        return implode($separator,$functions);
    }
    
    function getFormattedFunctions($separator=',')
    {
        $this->getFunctions();
        $functions=array();
        foreach ($this->functions as $function)
            $functions[]=$function->get('name');
        return implode($separator,$functions);
    }
    
    function getGroups()
    {
        if (!$this->groups)
        {    
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".Group::getFieldsAndKeyWithTable()." FROM ".Group::getTable().
                           " LEFT JOIN ".UserGroup::getInnerForJoin('group_id').
                           " LEFT JOIN ".UserGroup::getOuterForJoin('user_id').
                           " WHERE ".UserGroup::getTableField('user_id')."={user_id}".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return array();
            $this->groups=array();
            while ($item=$db->fetchObject('Group'))
            {               
               $item->site=$this->getSite();
               $this->groups[$item->get('id')]=$item->loaded();
            }            
        }
        return $this->groups;
    }
    
    function getSerializedI18nGroups()
    {
        $groups=array();
        foreach (explode(',',$this->groups) as $group)
           $groups[]=__($group,array(),'groups');
        return implode(",",$groups);
    }
    
    function getGroupNames()
    {
        if (!$this->groups_names)
        {    
            $this->groups_names=array();
            foreach ($this->getGroups() as $group)
            {
                $this->groups_names[$group->get('id')]=$group->get('name');
            }
        }
        return $this->groups_names;
    }
    
    function hasGroups($groups)
    {
        $user_groups=$this->getGroupNames();
        foreach ((array)$groups as $group)
        {
            if (in_array($group,$user_groups))
                 return true;   
        }    
        return false;
    }
    
    function getFunctionNames()
    {
        if (!$this->functions_name)
        {    
            $this->functions_names=array();
            foreach ($this->getFunctions() as $function)
            {
                $this->functions_names[$function->get('id')]=$function->get('name');
            }
        }
        return $this->functions_names;
    }
    
    function hasFunctions($functions)
    {
        $user_functions=$this->getFunctionNames();
        foreach ((array)$functions as $function)
        {
            if (in_array($function,$user_functions))
                 return true;   
        }    
        return false;
    }
        
        
    function toArray($fields=array())
    {
        $values=  parent::toArray($fields);    
        if (empty($fields) || in_array('name',$fields))
            $values['name']=ucwords((string)$this);
        if (empty($fields) || in_array('courtesy',$fields))
            $values['courtesy']=format_courtesy('Dear',$this->getGender());
        if (empty($fields) || in_array('gender',$fields))
            $values['gender']=format_gender($this->getGender(),1,true,true);        
        return $values;
    }
    
   /* function getManager()
    {
        if (!$this->manager)
        {
            $db=mfSiteDatabase::getInstance()           
                ->setObjects(array('User','UserTeam'))
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT {fields} FROM ".  UserTeamUsers::getTable().  
                           " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " LEFT JOIN ".UserTeam::getOuterForJoin('manager_id').                         
                           " WHERE ".UserTeamUsers::getTableField('user_id')."={user_id}".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
                return null;
            $items=$db->fetchObjects();
            if ($items->hasUser())
                $this->manager=$items->getUser();  
            if ($items->hasUserTeam())                
                $this->team=$items->getUserTeam();                           
        }    
        return $this->manager;
    }*/
      
/*    function getTeamTeleproUsersId()
    {           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('user_id'=>$this->get('id')))
            ->setQuery("SELECT ".User::getTableField('id')." FROM ".User::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').
                       " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').   
                       " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                       " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                       " WHERE ".UserTeam::getTableField('manager_id')."={user_id}".  
                            " AND ".UserFunction::getTableField('name')."='TELEPRO'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());  
        if (!$db->getNumRows())
            return array();
        $ids=array();
        while ($row=$db->fetchArray())
        {                              
           $ids[]=$row['id'];
        }                   
        return $ids;
    }
    
    function getTeamSalesUsersId()
    {           
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('user_id'=>$this->get('id')))
            ->setQuery("SELECT ".User::getTableField('id')." FROM ".User::getTable().
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').
                       " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').   
                       " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                       " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                       " WHERE ".UserTeam::getTableField('manager_id')."={user_id}".  
                            " AND ".UserFunction::getTableField('name')."='SALES'".
                       ";")               
            ->makeSiteSqlQuery($this->getSite());  
        if (!$db->getNumRows())
            return array();
        $ids=array();
        while ($row=$db->fetchArray())
        {                              
           $ids[]=$row['id'];
        }                   
        return $ids;
    }*/
    
    function getTeamMembersAndManagers()
    {
        if (!$this->team_members_and_managers)
        {
            
        }   
        return $this->team_members_and_managers;
    }
    
    function getSignature()
    {
        return md5(strtoupper($this->get('lastname')."-".$this->get('firstname')));
    }
    
    function isConnected()
    {
        //return (time() - strtotime($this->get('lastlogin')))  < 3600 * 8 ;
        return (boolean)$this->is_connected;
    }
    
    function hasEmail()
    {
        return (boolean)$this->get('email');
    }
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new UserFormatter($this);
        }
        return $this->formatter;
    }
    
    function hasLastLogin()
    {
        return (boolean)$this->get('lastlogin');
    }
    
    function hasLastPasswordGeneration()
    {
        return (boolean)$this->get('last_password_gen');
    }
    
    function toArrayForDocument()
    {
        return new UserFormatterForDocument($this->toArray());
    }
    
    function getCollaboraters()
    {       
        if ($this->collaboraters===null)
        {   
            $this->collaboraters=new mfArray();
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('user_id').
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " WHERE ".UserTeamUsers::getTableField('team_id')." IN('".implode("','",$this->getTeams()->getKeys())."')".
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          //  echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->collaboraters;            
            while ($item=$db->fetchObject('User'))
            {                              
               $this->collaboraters[$item->get('id')]=$item->loaded()->setSite($this->getSite());
            }            
        }
        return $this->collaboraters;
    }
    
    function getTeleproCollaborators()
    {
        if ($this->telepro_collaborators===null)
        {   
            $this->telepro_collaborators=new mfArray();
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('user_id').
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserTeamUsers::getTableField('team_id')." IN('".implode("','",$this->getTeams()->getKeys())."')".
                                    " AND ".UserFunction::getTableField('name')."='TELEPRO'".
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          //  echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->telepro_collaborators;            
            while ($item=$db->fetchObject('User'))
            {                              
               $this->telepro_collaborators[$item->get('id')]=$item->loaded()->setSite($this->getSite());
            }            
        }
        return $this->telepro_collaborators;
    }
    
    
    function getTeleproManagerCollaborators()
    {
        if ($this->telepro_manager_collaborators===null)
        {   
            $this->telepro_manager_collaborators=new mfArray();
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('user_id').
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserTeam::getTableField('manager_id')."='{user_id}'".
                                    " AND ".UserFunction::getTableField('name')."='TELEPRO'".
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          //  echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->telepro_manager_collaborators;            
            while ($item=$db->fetchObject('User'))
            {                              
               $this->telepro_manager_collaborators[$item->get('id')]=$item->loaded()->setSite($this->getSite());
            }            
        }
        return $this->telepro_manager_collaborators;
    }
    
     function getSaleManagerCollaborators()
    {
        if ($this->sale_manager_collaborators===null)
        {   
            $this->sale_manager_collaborators=new mfArray();
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".UserTeamUsers::getInnerForJoin('user_id').
                           " INNER JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".UserTeam::getTableField('manager_id')."='{user_id}'".
                                    " AND ".UserFunction::getTableField('name')."='SALES'".
                           " GROUP BY ".User::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
          //  echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->sale_manager_collaborators;            
            while ($item=$db->fetchObject('User'))
            {                              
               $this->sale_manager_collaborators[$item->get('id')]=$item->loaded()->setSite($this->getSite());
            }            
        }
        return $this->sale_manager_collaborators;
    }
    
    
    function toArrayForTransfer()
    {
        $values=array();
        foreach (array('firstname','lastname','email','password','username','mobile','sex') as $field)
            $values[$field]=$this->get($field);
        // foreign keys
        if ($this->isNotLoaded())
            return $values;
        $values['functions']=$this->getFormattedFunctions();
        if ($this->hasTeams())
            $values['teams']=(string)$this->getTeams()->getNames()->implode();
        return $values;
    }
    
          
    function hasUnlockedBy()
    {
        return (boolean) $this->get('unlocked_by');
    }
    
    function getUnlockedBy()
    {
        if($this->_unlocked_by==null)
            $this->_unlocked_by = new User($this->get('unlocked_by'), $this->getSite());
        return $this->_unlocked_by;
    }
    
    function unlockUser()
    {
        if($this->isNotLoaded())
            return $this;
        $this->add(array('is_locked'=>'NO',
                        'locked_at'=>NULL,
                        'is_active'=>'YES',
                        'number_of_try'=>0));
        $this->save();
    }
    
    function hasLockedAt()
    {
        return (boolean)$this->get('locked_at');
    }
    
    function lockUser()
    {
        if($this->isNotLoaded())
            return $this;
        $this->add(array('is_locked'=>'YES',
                        'locked_at'=>date("Y-m-d H:i:s"),
                        'is_active'=>'NO'));
        $this->save();
        return $this;
    }
    
    function isLocked()
    {
        return $this->get('is_locked')=='YES';
    }
    
    function resetNumberOfTriesAndUnlocker()
    {
        $this->add(array('number_of_try'=>0,'locked_at'=>null,'unlocked_by'=>null))->save();
        return $this;
    }
    
    function resetNumberOfTries()
    {
        $this->add(array('number_of_try'=>0))->save();
        return $this;
    }
    
    
    function getProfile()
    {
        return $this->profile=$this->profile===null?new UserProfiles($this,$this->getSite()):$this->profile;
    }
    
    function updateTeam($teams,$is_team_manager=false)
    {       
        if ($teams===null)
            return $this;        
        if (!$teams->isEmpty() && $teams->getFirst()!='0')
        {                       
            // Remove old 
             $db=mfSiteDatabase::getInstance()                           
                ->setParameters(array('user_id'=>$this->get('id'),'team_id'=>$teams->getFirst()))
                ->setQuery("DELETE FROM ".  UserTeamUsers::getTable().                                              
                           " WHERE user_id='{user_id}' AND team_id!='{team_id}'".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());               
            $team_user=new UserTeamUsers(array('user'=>$this,'team_id'=>$teams->getFirst()));     
            $team_user->save();
            if ($is_team_manager)                            
                $team_user->getTeam()->set('manager_id',$this)->save();                        
        }
        else
        {
            $db=mfSiteDatabase::getInstance()                           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("DELETE FROM ".  UserTeamUsers::getTable().                                              
                           " WHERE ".UserTeamUsers::getTableField('user_id')."={user_id}".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
        }    
        return $this;
    }
    
    
    function createOrUpdateTeam($team_id,$team,$manager_id,$is_team_manager=false)
    {               
        if ($team_id===null)
            return $this;
        if ($team_id)
        {    
            $team_user=new UserTeamUsers(array('user'=>$this,'team_id'=>$team_id));                       
            $team_user->save();                        
             if ($is_team_manager)            
            {    
                $team_user->getTeam()->set('manager_id',$this)->save(); 
            }
        }
        else
        {
            $db=mfSiteDatabase::getInstance()                           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("DELETE FROM ".  UserTeamUsers::getTable().                                              
                           " WHERE ".UserTeamUsers::getTableField('user_id')."={user_id}".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());              
            if ($team)
            {
                $user_team=new UserTeam($team,$this->getSite());
                if ($user_team->isNotLoaded())    
                {                      
                   $user_team->set('manager_id',($manager_id=='me'?$this:$manager_id))->save();                                     
                }
                $team_user=new UserTeamUsers(array('user'=>$this,'team_id'=>$user_team));            
                $team_user->save();
            }                            
        }   
        return $this; 
    }
    
    function hasCreator()
    {
        return (boolean)$this->get('creator_id');
    }
    
      function getCreator()
    {
        return $this->_creator_id=$this->_creator_id?new User($this->get('creator_id'),$this->get('application'),$this->getSite()):$this->_creator_id;
    }           
        
    function addManager(User $manager)
    {
        if ($this->team_managers===null)
            $this->team_managers=new UserCollection(null,$this->getSite());
        if ($manager->isNotLoaded())
            return $this;
        if (isset($this->team_managers[$manager->get('id')]))
            return $this;
        $this->team_managers[$manager->get('id')]=$manager;
        return $this;
    }    
    
   function addTeam(UserTeam $team)
   {
        if ($this->teams===null)
            $this->teams=new UserTeamCollection(null,$this->getSite());
        if ($team->isNotLoaded())
            return $this;
        if (isset($this->teams[$team->get('id')]))
            return $this;
        $this->teams[$team->get('id')]=$team;
        return $this;
   }
    
   
   function hasUserPermission()
   {
       return $this->get('has_user_permissions');
   }
   
   
    function getTeamsFromManagerAndMembers()
    {
        if ($this->teams_from_members_and_manager===null)
        {    
            $this->teams_from_members_and_manager=new UserTeamCollection(null,$this->getSite());
            if ($this->isNotLoaded())
                return $this->teams_from_members_and_manager;
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().
                           " LEFT JOIN ".UserTeamUsers::getInnerForJoin('team_id').
                           " WHERE ".UserTeamUsers::getTableField('user_id')."='{user_id}' OR ".UserTeam::getTableField('manager_id')."='{user_id}'".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
         //   echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->teams_from_members_and_manager;            
            while ($item=$db->fetchObject('UserTeam'))
            {                              
               $this->teams_from_members_and_manager[$item->get('id')]=$item->loaded()->setSite($this->getSite());
            }            
        }
        return $this->teams_from_members_and_manager;
    }
    
    
     function getTeamsAsManager()
    {
        if ($this->teams_as_manager===null)
        {    
            $this->teams_as_manager=new UserTeamCollection(null,$this->getSite());
            if ($this->isNotLoaded())
                return $this->teams_as_manager;
            $db=mfSiteDatabase::getInstance()           
                ->setParameters(array('user_id'=>$this->get('id')))
                ->setQuery("SELECT ".UserTeam::getFieldsAndKeyWithTable()." FROM ".UserTeam::getTable().
                           " LEFT JOIN ".UserTeamUsers::getInnerForJoin('team_id').
                           " WHERE ".UserTeam::getTableField('manager_id')."='{user_id}'".                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());  
         //   echo $db->getQuery();
            if (!$db->getNumRows())
                return $this->teams_as_manager;            
            while ($item=$db->fetchObject('UserTeam'))
            {                              
               $this->teams_as_manager[$item->get('id')]=$item->loaded()->setSite($this->getSite());
            }            
        }
        return $this->teams_as_manager;
    }
    
    
    function generatePassword()
    {          
        $password=mfTools::generatePassword(10);
        $this->add(array('password'=>md5($password),
                         'clear_password'=>$password,
                         "last_password_gen"=>date("Y-m-d H:i:s")));            
        return $this;
    }
    
      function hasCompany()
    {
        return (boolean)$this->get('company_id');
    }
    
      function getCompany()
    {
        return $this->_company_id=$this->_company_id===null?new CustomerContractCompany($this->get('company_id'),$this->getSite()):$this->_company_id;
    }
    
      function isSecureByCode()
    {
        return $this->get('is_secure_by_code','NO')=='YES';
    }
    
    
    function getData()
    {
        return $this->data= $this->data===null?new UserFormatterApi($this):$this->data;                                   
    }
    
    
     function toArrayForApi($options)
    {
        if ($this->formatter_api===null)
        {
            $this->formatter_api=new UserItemFormatterApi($this,$options);
        }
        return $this->formatter_api;
    }
    
    function toArrayForProfileApi(){
        $values= array();
        foreach (array("id","username","firstname","lastname","email","password") as $field){
            $values[$field]= $this->get($field);
        }
        $values['profile']= $this->getProfile()->getProfile()->getI18n()->toArray();
        $values['groups']= $this->getGroupNames();
        return $values;
    }
    
    
    function save()
     {
         parent::save();
         mfCacheFile::removeCache('users','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('users','admin',$this->getSite());         
         return $this;
     }
     
     
     function isSuperAdminByPermissions(mfArray $permissions)
     {
         if ($permissions->isEmpty())
             return false;
          $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$this->get('id')))                
                ->setQuery("SELECT count(".Permission::getTableField('id').") FROM ".Permission::getTable().
                           " LEFT JOIN ".UserPermission::getInnerForJoin('permission_id').
                           " LEFT JOIN ".GroupPermission::getInnerForJoin('permission_id').                      
                           " LEFT JOIN ".UserGroup::getTable()." ON ".UserGroup::getTableField('group_id')."=".GroupPermission::getTableField('group_id')." OR ".
                                UserGroup::getTableField('user_id')."=".UserPermission::getTableField('user_id').
                           " LEFT JOIN ".UserGroup::getOuterForJoin('group_id'). 
                           " LEFT JOIN ".UserGroup::getOuterForJoin('user_id').
                           " WHERE ".Permission::getTableField('application=@@APPLICATION@@').
                                " AND ".Group::getTableField("application=@@APPLICATION@@").
                                " AND ".User::getTableField("id='{user_id}'").
                                " AND ".User::getTableField("application=@@APPLICATION@@").
                                " AND ".User::getTableField("is_active='YES'").
                                " AND ". Permission::getTableField("name")." IN('".$permissions->implode("','")."')".                              
                          //      " AND ".User::getTableField("is_locked='NO'").   //SECURITY 
                                " AND ".User::getTableField("status='ACTIVE'").
                                " AND ".UserGroup::getTableField("is_active='YES'").
                                " AND ".Group::getTableField("is_active='YES'").
                           ";")               
                ->makeSqlQuery();      
         $row=$db->fetchRow();                          
         return $row[0] > 0;
     }
     
     //user_action_view_all , user_action_view_all_telepro_manager , user_action_view_all_sale_manager
    function isAuthorized($action='view' )
    {
        $user= mfcontext::getInstance()->getUser();
        if ($user->hasCredential([['superadmin','user_action_view_all']]))
            return true;
        if ($user->getGuardUser()->get('id') == $this->get('id'))
             return true;
        if ($user->hasCredential(array(array('user_action_view_all_telepro_manager'))) && $user->getGuardUser()->getTeleproManagerCollaborators()->getKeys()->in($this->get('id')))
            return true;
        if ($user->hasCredential(array(array('user_action_view_all_sale_manager'))) && $user->getGuardUser()->getSaleManagerCollaborators()->getKeys()->in($this->get('id')))
            return true;
         
        return false;
    }
}
