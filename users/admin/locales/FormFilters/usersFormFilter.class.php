<?php

class UsersFormFilter extends mfFormFilterBase {
  
     protected $user=null,$language=null,$conditions=null,$site=null;
    
    function __construct($user)
    {                      
       $this->user=$user;          
       $this->language=$user->getCountry();
       $this->conditions=new ConditionsQuery(); 
       $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));
       parent::__construct();      
    } 

    function getUser()
    {
        return $this->user;
    }
    
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
       $settings=  UserSettings::load();
       if ($this->getUser()->hasGroups(array('telepro_manager','sales_manager')) || $this->getUser()->hasCredential(array(array('users_filter_user_as_user_team'))))
       {       
            $this->conditions->setWhere(User::getTableField('id')." IN('".$this->getUser()->getGuardUser()->getTeamUsers()->getKeys()->implode("','")."')");    
       }   
       if ($this->getUser()->hasCredential(array(array('users_filter_user_creator'))))
       {       
            $this->conditions->setWhere(User::getTableField('creator_id')."='{user_id}'");    
       } 
       
       
       $this->setClass('User');
    //   var_dump($this->conditions);
      $this->setDefaults(array(
            'order'=>array(
                            "id"=>"asc",
            ),
            'search'=>array(
                          //"username"=>""
            ),
            'equal'=>array(
                            "status"=>"ACTIVE",
                            "is_active"=>"YES"
            ),
            'nbitemsbypage'=>100,
       ));     
       $this->setFields(array( 
                            'group_id'=>array(
                                            'class'=>'UserGroup',
                                            'search'=>array('conditions'=>                                                
                                                 UserGroup::getTableField('group_id')."='{group_id}'"
                                                 )
                              ),   
                             'profile_id'=>'UserProfiles',
                            'team_id'=>'UserTeamUsers',
                            'username'=>array(
                                            'class'=>'User',
                                            'search'=>array('conditions'=>                                                
                                                 User::getTableField('username')." COLLATE UTF8_GENERAL_CI LIKE '%%{username}%%'"
                                                 )
                              ), 
                             'firstname'=>array(
                                            'class'=>'User',
                                            'search'=>array('conditions'=>                                                
                                                 User::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{firstname}%%'"
                                                 )
                              ), 
                              'lastname'=>array(
                                            'class'=>'User',
                                            'search'=>array('conditions'=>                                                
                                                 User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%'"
                                                 )
                              ), 
                              'manager_id'=>array(
                                            'class'=>'UserTeam',                                         
                              ), 
                              'has_user_permissions'=>array(
                                     'class'=>'UserPermission',
                                     'name'=>'id'
                              ),
                            'query'=>array(      
                                                'class'=>'User',
                                                'search'=>array('conditions'=> "(".                                               
                                                     User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{query}%%' OR ".
                                                     User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{query}%%' OR ".
                                                     User::getTableField('email')." COLLATE UTF8_GENERAL_CI LIKE '%%{query}%%'".
                                                          ")"
                                                     )
                                        ),
           ));
       $this->setQuery("SELECT {fields},".
                     //  "SELECT {fields} ".
                            "(SELECT GROUP_CONCAT(".UserFunctionI18n::getTableField('value')." ORDER BY ".UserFunctionI18n::getTableField('value')." ASC)".
                                 " FROM ".UserFunctions::getTable().
                            " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                            " LEFT JOIN ".UserFunctionI18n::getTable()." ON ".UserFunctions::getTableField('function_id')."=".UserFunctionI18n::getTableField('function_id').
                                    " AND ".UserFunctionI18n::getTableField('lang')."='{lang}'".
                            " WHERE ".UserFunctions::getTableField('user_id')."=".User::getTableField('id').
                            ") as `User.functions` ".
                                    ",".
                            "(SELECT GROUP_CONCAT(".Group::getTableField('name')." ORDER BY ".Group::getTableField('name')." ASC)".
                                " FROM ".UserGroup::getTable().
                            " LEFT JOIN ".UserGroup::getOuterForJoin('group_id')." AND ".Group::getTableField('name')."!='superadmin'".
                            " WHERE ".UserGroup::getTableField('user_id')."=".User::getTableField('id'). 
                            ") as `User.groups` ".
                                ",".
                            "(SELECT GROUP_CONCAT(".UserTeam::getTableField('name')." ORDER BY ".UserTeam::getTableField('name')." ASC)".
                                " FROM ".UserTeamUsers::getTable().
                            " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id'). 
                            " WHERE ".UserTeamUsers::getTableField('user_id')."=".User::getTableField('id').                                             
                            ") as `User.teams` ".                                                            
                                ",".
                            "(SELECT GROUP_CONCAT(".UserProfileI18n::getTableField('value')." ORDER BY ".UserProfileI18n::getTableField('value')." ASC)".
                                 " FROM ".UserProfiles::getTable().
                            " LEFT JOIN ".UserProfiles::getOuterForJoin('profile_id').
                            " LEFT JOIN ".UserProfileI18n::getTable()." ON ".UserProfiles::getTableField('profile_id')."=".UserProfileI18n::getTableField('profile_id').
                                    " AND ".UserProfileI18n::getTableField('lang')."='{lang}'".
                            " WHERE ".UserProfiles::getTableField('user_id')."=".User::getTableField('id').
                            ") as `User.profiles` ,".
                            UserPermission::getTableField('id')." as `has_user_permissions` ,".
                            "(SELECT GROUP_CONCAT(". Permission::getTableField('name')."  ORDER BY ".Permission::getTableField('name')." ASC )".
                                " FROM ".Permission::getTable().
                            " INNER JOIN ". UserPermission::getInnerForJoin('permission_id'). 
                            " WHERE ".UserPermission::getTableField('user_id')."=".User::getTableField('id').                                             
                            ") as `user_permissions` ".   
                       " FROM ".User::getTable().                       
                       " LEFT JOIN ".UserTeamUsers::getInnerForJoin('user_id').               
                       " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                       " LEFT JOIN ".UserPermission::getInnerForJoin('user_id').
                    //   " LEFT JOIN ".UserTeam::getOuterForJoin('manager_id','manager1').
     //                  " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').
     //                  " LEFT JOIN ".UserTeam::getOuterForJoin('manager_id','manager1').
     //                  " LEFT JOIN ".UserTeam::getOuterForJoin('manager2_id','manager2').
                       " LEFT JOIN ".User::getOuterForJoin('company_id').
                       " LEFT JOIN ".User::getOuterForJoin('callcenter_id').    
                       " LEFT JOIN ".User::getOuterForJoin('creator_id','creator').   
                       " LEFT JOIN ".UserGroup::getInnerForJoin('user_id').
                       " LEFT JOIN ".UserProfiles::getInnerForJoin('user_id').
                       " LEFT JOIN ".UserProfiles::getOuterForJoin('profile_id').
                       " LEFT JOIN ".UserProfileI18n::getInnerForJoin('profile_id')." AND ".UserProfileI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".User::getOuterForJoin('unlocked_by','unlockedby').    
                        " WHERE ".User::getTableField("application")."='admin' AND ".User::getTableField("username")." NOT LIKE 'superadmin%%'".
                             $this->conditions->getWhere('AND').
                             //" AND ".User::getTableField('id')."=1359".
                       " GROUP BY ".User::getTableField('id').
                       ";");
       //var_dump($this->query);
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "username"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "firstname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "email"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastlogin"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "last_password_gen"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "query"=>new mfValidatorString(array("required"=>false)),
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "username"=>new mfValidatorString(array("required"=>false)),
                            "firstname"=>new mfValidatorString(array("required"=>false)),
                            "lastname"=>new mfValidatorString(array("required"=>false)),
                            "email"=>new mfValidatorString(array("required"=>false)),    
                            "number_of_try"=>new mfValidatorString(array("required"=>false)),     
                        //    "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),                          
                           ),array("required"=>false)),
            'equal' => new mfValidatorSchema(array(   
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                            "has_user_permissions"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("No permission"),"IS_NOT_NULL"=>__("Permissions")),"key"=>true,"required"=>false)),
                            "group_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+UserUtils::getGroupsForSelect(),"key"=>true,"required"=>false)),
                            "profile_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+UserUtils::getProfilesForSelect(),"key"=>true,"required"=>false)),
                            "is_active"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"required"=>false)),
                            "team_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("No team"))+UserTeamUtils::getTeamsWithConditionsForSelect($this->conditions),"key"=>true,"required"=>false)),
                            "manager_id"=>new mfValidatorChoice(array("choices"=>UserTeamUtils::getManagersForSelect()->unshift(array(""=>"","IS_NULL"=>__("No manager")))->toArray(),"key"=>true,"required"=>false)),
                            "creator_id"=>new mfValidatorChoice(array("choices"=>UserUtils::getCreatorsForSelect()->unshift(array(""=>"","IS_NULL"=>__("No creator")))->toArray(),"key"=>true,"required"=>false)),
                            "unlocked_by"=>new mfValidatorChoice(array("choices"=>UserUtils::getUnLockerUsers()->unshift(array(""=>"","IS_NULL"=>__("No user")))->toArray(),"key"=>true,"required"=>false)),
                            "is_locked"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                            "is_secure_by_code"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),    
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
       if ($settings->hasCallCenter())
       {
            $this->equal->addValidator("callcenter_id",new mfValidatorChoice(array("choices"=>array(""=>"")+Callcenter::getCallcenterForSelect(),"key"=>true,"required"=>false)));
       }          
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_user_remove'))))
       {               
         $this->equal->addValidator("status",new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>"ACTIVE","DELETE"=>"DELETE"),"key"=>true,"required"=>false)));
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_user_list_company'))))
       {          
            
            $this->equal->addValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));       
       }
    }
    
    
    function getMapping($fields=array())
    {
        if ($this->mapping===null)
        {
            $this->mapping=new mfArray();
            if (!$fields)            
                $fields = $this->getFields();            
            foreach ($fields as $field)
            {
               if (method_exists($this->$field, 'getMapping'))
                 $this->mapping[$field]=array('options'=>$this->$field->getMapping(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
               else
                 $this->mapping[$field]=array('options'=>$this->$field->getOptions(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
            }          
        }
        return $this->mapping;
    }
   
}

