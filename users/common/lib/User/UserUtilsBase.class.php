<?php

class UserUtilsBase {
       
    static function getUsersByFunctionForSelect($function,$site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('name'=>$function))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').                           
                           " WHERE ".UserFunction::getTableField('name')."='{name}'".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user->loaded()->setSite($site);
        }
        return $users;
    }   
    
    static function getUsersSortedByFirstnameForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                           
                           " WHERE application='admin'".
                           " ORDER BY ".User::getTableField('firstname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    }  
    
     static function getActiveUsersSortedByFirstnameForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                           
                           " WHERE application='admin' AND is_active='YES' ".
                           " ORDER BY ".User::getTableField('firstname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    }  
    
      static function getActiveUsersSortedByLastnameForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                           
                           " WHERE application='admin' AND is_active='YES' AND status ='ACTIVE'".
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    }  
    
     static function getActiveUsersSortedByLastnameAndFunctionForSelect($site=null)
    {         
         $lang=mfContext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setObjects(array('User','UserFunctionI18n','UserFunction'))
                ->setParameters(array('lang'=>$lang))
                ->setQuery("SELECT {fields} FROM ".User::getTable().     
                           " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " INNER JOIN ".UserFunctionI18n::getInnerForJoin('function_id')." AND ".UserFunctionI18n::getTableField('lang')."='{lang}'".
                           " WHERE application='admin' AND is_active='YES' ".
                         //  " GROUP BY ".User::getTableField('id').
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
			//	echo $db->getQuery();
        if (!$db->getNumRows())
            return array();
        $functions=array();
        while ($items=$db->fetchObjects())
        {                       
           if ($items->hasUserFunction() && $items->hasUserFunctionI18n())
           {
               $functions[$items->getUserFunctionI18n()->get('value')][$items->getUser()->get('id')]=mb_strtoupper($items->getUser()->get('lastname')." ".$items->getUser()->get('firstname'));
           }   
           else
           {
		$functions[__('No function')][$items->getUser()->get('id')]=mb_strtoupper($items->getUser()->get('lastname')." ".$items->getUser()->get('firstname'));             
           }    
        }
        ksort($functions);
        return $functions;
    }  
    
    
    
     static function getUsersForSelect($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                           
                           " WHERE application='admin'".
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    }   
    
    static function getUsers($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                           
                           " WHERE application='admin'".
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        }
        return $users;
    } 
    
    static function getActiveUsers($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                           
                           " WHERE application='admin' AND is_active='YES' AND status='ACTIVE'".
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    }  
    
    static function checkUsers($users,$site=null)
    {
        if (empty($users))
            return array();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT id FROM ".User::getTable().                           
                           " WHERE application='admin' AND id IN(".implode(",",$users).");")               
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
    
    static function getUsersByFunctionsForSelect($functions,$site=null)
    {       
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().   
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE application='admin'".
                                " AND ".UserFunction::getTableField('name')." IN('".implode("','",$functions)."')".
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
      //  echo $db->getQuery();
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    }     
    
    static function getOrderedUsersByFunctionsForSelect($functions,$site=null)
    {       
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().   
                           " LEFT JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " LEFT JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE application='admin'".
                                " AND ".UserFunction::getTableField('name')." IN('".implode("','",$functions)."')".
                          // " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user;
        }       
        self::sortUsers($users,true);
        return $users;
    }     
    
    static function compareSortUser($a, $b) 
    {        
        if ($a->getUpperCaseLastName() == $b->getUpperCaseLastName()) 
                return 0;
        return ($a->getUpperCaseLastName() < $b->getUpperCaseLastName()) ? -1 : 1;
    }
    

    static function sortUsers(&$users,$upper=false)
    {
        uasort($users,array('self','compareSortUser')); 
        if ($upper)
            $users=self::upperUsers($users);
    }
    
    protected static function upperUsers($users)
    {
        foreach ($users as $name=>$value)
           $users[$name]=strtoupper((string)$value);
        return $users;
    }
    
    
    static function getActiveUsersSortedByFirstnameByGroups($site=null)
    {
        $groups=new GroupCollection(null,$site);
         $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('User','Group'))
                ->setQuery("SELECT {fields} FROM ".User::getTable().
                           " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                           " INNER JOIN ".UserGroup::getOuterForJoin('group_id').
                         //  " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                         //  " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE ".User::getTableField('application')."='admin' AND ".
                                     User::getTableField('is_active')."='YES' AND ".
                                     Group::getTableField('application')."='admin' AND ".
                                     Group::getTableField('is_active')."='YES' AND ".
                                     Group::getTableField('name')." IN('telepro','assistant','commercial')".
                           " ORDER BY ".Group::getTableField('name')." ASC,".User::getTableField('firstname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $groups;        
        while ($items=$db->fetchObjects())
        {
            if (!isset($groups[$items->getGroup()->get('id')]))
            {    
                 $groups[$items->getGroup()->get('id')]=$items->getGroup();
                 $groups[$items->getGroup()->get('id')]->users=new mfArray();
            }     
            $groups[$items->getGroup()->get('id')]->users[$items->getUser()->get('id')]=$items->getUser();
        }
        return $groups->sortByNameI18n();
    }  
    
    static function getActiveUsersForValidator($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT id FROM ".User::getTable().                           
                           " WHERE application='admin' AND ".User::getTableField('is_active')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();
        $ids=array();
        while ($row=$db->fetchRow())
        {
           $ids[$row[0]]=$row[0];
        }
        return $ids;
    }   
     
    
    static function getNumberOfUsersConnected($site=null)
    {  
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('date'=>date('Y-m-d H:i:s',time() - 300)))
                ->setQuery("SELECT count(".User::getTableField('id').") FROM ".User::getTable().
                        " INNER JOIN ".Session::getInnerForJoin('user_id').
                        " WHERE ".Session::getTableField('last_time')." >='{date}'".                      
                        ";")               
                ->makeSiteSqlQuery($site);   
//echo $db->getQuery();        
        $row=$db->fetchRow();
        return $row[0];
      
    }
    
    static  function getConnectedUsers($site=null)
    {  
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('date'=>date('Y-m-d H:i:s',time() - 300)))
                ->setQuery("SELECT * FROM ".User::getTable().
                        " INNER JOIN ".Session::getInnerForJoin('user_id').
                        " WHERE ".Session::getTableField('last_time')." >='{date}' ;")               
                ->makeSiteSqlQuery($site);
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        { 
            $users[]=$user->loaded()->setSite($site);  
        }            
        return $users;
    }
    
    
    static function getGroupsForSelect($site=null)
    {
        $list=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".Group::getFieldsAndKeyWithTable()." FROM ".Group::getTable().
                        " INNER JOIN ".UserGroup::getInnerForJoin('group_id').
                        " WHERE application='admin' AND name!='superadmin'".                
                        " GROUP BY ".Group::getTableField('id').
                        " ORDER BY name COLLATE UTF8_GENERAL_CI ASC ".
                        ";")               
                ->makeSiteSqlQuery($site);
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;        
        while ($group=$db->fetchObject('Group'))
        { 
            $list[$group->get('id')]=__($group->get('name')); //,array(),'messages','');  
        }            
        return $list;
    }        
    
    
    
    static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".User::getTable().
                           " WHERE application = 'admin' AND username !='admin' AND username!='superadmin'".
                           ";")               
                ->makeSiteSqlQuery($site);         
        $db->setQuery("DELETE FROM ".CallCenter::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("ALTER TABLE ".CallCenter::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
         
        $db->setQuery("DELETE FROM ".UserTeam::getTable().";")               
                ->makeSiteSqlQuery($site); 
        $db->setQuery("ALTER TABLE ".UserTeam::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
        
        $db->setQuery("DELETE FROM ".UserTeamUsers::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("ALTER TABLE ".UserTeamUsers::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site);                 
          
        $db->setQuery("DELETE FROM ".UserLogoutRequest::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("ALTER TABLE  ".UserLogoutRequest::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
        
        $db->setQuery("DELETE FROM ".UserFunctions::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("ALTER TABLE ".UserFunctions::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
         
        $db->setQuery("DELETE FROM ".UserRemember::getTable().";")               
                ->makeSiteSqlQuery($site); 
         $db->setQuery("ALTER TABLE ".UserRemember::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); 
        
         $db->setParameters(array('session'=>session_id()))
            ->setQuery("DELETE FROM ".Session::getTable()." WHERE session!='{session}';")               
                ->makeSiteSqlQuery($site);   
             
       /*   $db->setQuery("DELETE FROM ".UserTeamManager::getTable().";")               
                ->makeSiteSqlQuery($site); 
        $db->setQuery("ALTER TABLE ".UserTeamManager::getTable()." AUTO_INCREMENT = 1;")               
                ->makeSiteSqlQuery($site); */
        
         $db->setQuery("TRUNCATE ".UserPermission::getTable().";")               
                ->makeSiteSqlQuery($site);          
    }
    
    static function changePasswordForUserForSites(SiteCollection $sites,$username="",$password="")
    {       
        $messages=new mfArray();
        foreach ($sites as $site)
        {
            try
            {
            $db=mfSiteDatabase::getInstance()
                ->setParameters(array('username'=>$username,'password'=>md5($password),'updated_at'=>date("Y-m-d H:i:s")))                
                ->setQuery("UPDATE  ".User::getTable().
                           " SET password='{password}', updated_at='{updated_at}', last_password_gen='{updated_at}'".
                           " WHERE application = 'admin' AND username ='{username}'".
                           ";")               
                ->makeSiteSqlQuery($site);          
            }
            catch (mfException $e)
            {
                $messages->push($e->getMessage());
            }
        }    
        return $messages;
    }
    
  
    
    static  function getConnectedUsersByUsers($users,$site=null)
    {  
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('date'=>date('Y-m-d H:i:s',time() - 300 )))
                ->setQuery("SELECT ".Session::getTableField('user_id')." FROM ".Session::getTable().                               
                           " LEFT JOIN ".UserLogoutRequest::getTable()." ON ".UserLogoutRequest::getTableField('session_id')."=".Session::getTableField('id').      
                           " WHERE ".Session::getTableField('last_time')." IN(".
                                        "SELECT MAX(last_time) FROM ".Session::getTable().
                                            " WHERE ".Session::getTableField('last_time')." >='{date}'".
                                                " AND ".Session::getTableField('user_id')." IN('".implode("','",$users)."')".
                                            " GROUP BY ".Session::getTableField('user_id').       
                                        ")".
                                    " AND ".Session::getTableField('user_id')." IN('".implode("','",$users)."')".
                                    " AND ".Session::getTableField('last_time')." >='{date}'".
                                     " AND (".
                                        UserLogoutRequest::getTableField('logout')."!='LOGOUT'".
                                        " OR ".UserLogoutRequest::getTableField('id')." IS NULL".
                                        ")".
                                    ";")               
                ->makeSiteSqlQuery($site);
       //echo $db->getQuery();
        if (!$db->getNumRows())
            return array();       
        $list=array();
        while ($row=$db->fetchArray())
        { 
            $list[]=$row['user_id'];  
        }            
        return $list;
    }
    
    /* REQUETE A REVOIR TROP LONGUE
     SELECT t_sessions.user_id FROM t_sessions LEFT JOIN t_users_logout_request ON t_users_logout_request.session_id=t_sessions.id WHERE t_sessions.last_time IN(SELECT MAX(last_time) FROM t_sessions GROUP BY t_sessions.user_id) AND t_sessions.user_id IN('341','590','972','973','974','975','976','977','978','979','980','981','982','983','984','985','986','987','988','989','990','991','992','993','994','995','996','997','998','1000','1001','1002','1003','1004','1005','1006','1007','1009','1010','1011','1012','1013','1014','1016','1017','1018','1019','1020','1021','1022','1023','1024','1025','1026','1027','1028','1029','1030','1031','1032','1033','1034','1035','1036','1037','1038','1039','1040') AND t_sessions.last_time >='2016-12-22 12:20:49' AND (t_users_logout_request.logout!='LOGOUT' OR t_users_logout_request.id IS NULL);
     */
    static function getConnectedUsersFromPager($pager)
    {        
        $users=array_keys($pager->getItems());
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('date'=>date('Y-m-d H:i:s',time() - 300 )))
                ->setQuery("SELECT ".Session::getTableField('user_id')." FROM ".Session::getTable().                               
                           " LEFT JOIN ".UserLogoutRequest::getTable()." ON ".UserLogoutRequest::getTableField('session_id')."=".Session::getTableField('id').      
                           " WHERE ".Session::getTableField('last_time')." IN(".
                                        "SELECT MAX(last_time) FROM ".Session::getTable().
                                        " WHERE ".Session::getTableField('last_time')." >='{date}'".
                                            " AND ".Session::getTableField('user_id')." IN('".implode("','",$users)."')".
                                        " GROUP BY ".Session::getTableField('user_id').       
                                        ")".
                                    " AND ".Session::getTableField('user_id')." IN('".implode("','",$users)."')".
                                    " AND ".Session::getTableField('last_time')." >='{date}'".
                                     " AND (".
                                        UserLogoutRequest::getTableField('logout')."!='LOGOUT'".
                                        " OR ".UserLogoutRequest::getTableField('id')." IS NULL".
                                        ")".
                                    ";")               
                ->makeSiteSqlQuery($pager->getSite());
       //echo $db->getQuery();
        if (!$db->getNumRows())
            return ;               
        while ($row=$db->fetchArray())
        { 
            $pager[$row['user_id']]->is_connected=true;
        }                    
    }
    
    
    static function getActiveCollectionUsers($site=null)
    {
        $users=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                           
                           " WHERE application='admin' AND is_active='YES' AND status='ACTIVE'".
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;  
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=$user->loaded()->setSite($site);
        }
        return $users;
    } 
    
    
    static function getUnLockerUsers($site=null)
    {
        $users=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable('unlocker')." FROM ".User::getTable().
                           " INNER JOIN ".User::getOuterForJoin('unlocked_by','unlocker').                           
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;  
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    } 
    
     static function getDeletersUsers($site=null)
    {
        $users=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                           " INNER JOIN ".SiteIpBlacklist::getInnerForJoin('deleted_by').                           
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;  
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    } 
    
    
    static function getProfilesForSelect($site=null)
    {
        $list=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getCountry()))
                ->setQuery("SELECT ".UserProfileI18n::getFieldsAndKeyWithTable()." FROM ".UserProfile::getTable().
                        " INNER JOIN ".UserProfiles::getInnerForJoin('profile_id').           
                        " INNER JOIN ".UserProfiles::getOuterForJoin('user_id').  
                        " INNER JOIN ".UserProfileI18n::getInnerForJoin('profile_id')." AND lang='{lang}'".                                           
                        " GROUP BY ".UserProfile::getTableField('id').
                        " ORDER BY value COLLATE UTF8_GENERAL_CI ASC ".
                        ";")               
                ->makeSiteSqlQuery($site);
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;        
        while ($item=$db->fetchObject('UserProfileI18n'))
        { 
            $list[$item->get('profile_id')]=(string)$item;
        }            
        return $list;
    }   
    
    
     static function getCreatorsForSelect($site=null)
    {
        $users=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable('creator')." FROM ".User::getTable().  
                           " INNER JOIN ".User::getOuterForJoin('creator_id','creator').  
                           " GROUP BY ".User::getTableField('id','creator').
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".                        
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $users;  
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    } 
    
     static function generatePassword(mfArray $selection,$site=null)
     {
        $site=$site?$site:mfContext::getInstance()->getSite()->getSite();      
        $messages=new mfArray();
        if ($selection->isEmpty())
             return $messages->push(__("No selection"));
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT * FROM ".User::getTable().                             
                           " WHERE email!='' AND id IN('".$selection->implode("','")."')".              
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $messages->push(__("No email in selection"));  
        $collection =new UserCollection(null, 'admin',$site);
        while ($item=$db->fetchObject('User'))
        {          
           $collection[]=$item->loaded()->setSite($site);
        }  
        $collection->loaded();
        $company=SiteCompanyUtils::getSiteCompany($site);   
        $collection_email_spooler=new EmailerSpoolerCollection();
        foreach ($collection as $user)
        {
             try
             {        
                $user->generatePassword();
                $message=mfContext::getInstance()->getComponentController()->getComponentContent('/users/emailForPassword', array('COMMENT'=>false,'user'=>$user));                                                
               // echo $message."<br/>";                
                $email_spooler=new EmailerSpooler();
                $email_spooler->add(array('to'=>$user->get('email'),                                   
                                'site_id'=>$collection->getSite(),
                                'from'=>$company->get('email'),
                                'body'=>$message,
                                'subject'=>__("New password"),
                               ));
                $collection_email_spooler[]=$email_spooler;
             }
             catch (mfException $e)
             {
                 $messages->push(__("User %s:",$user->get('email')).$e->getMessage());
             }
        }      
        $messages->push(__('New password have been sent to selection'));
        $collection->save();
        $collection_email_spooler->save();
        return $messages;
     }
     
     static function getUsersByUserFunctionsForSelect($functions,$site=null)
    {       
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().   
                           " INNER JOIN ".UserFunctions::getInnerForJoin('user_id').
                           " INNER JOIN ".UserFunctions::getOuterForJoin('function_id').
                           " WHERE application='admin'".
                                " AND ".UserFunction::getTableField('name')." IN('".implode("','",$functions)."')".
                           " GROUP BY ".User::getTableField('id').   
                           " ORDER BY ".User::getTableField('lastname')." COLLATE UTF8_GENERAL_CI ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
       //  echo $db->getQuery();
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=mb_strtoupper($user->get('lastname')." ".$user->get('firstname'));
        }
        return $users;
    }     
    
    static function updateProfileForMultipleUsers($profile_id,$selection,$site=null)
    {        
        $messages=new mfArray();
        $collection=new UserProfilesCollection();
        if ($selection->isEmpty())
             return $messages->push(__("No selection"));
        //get all existing users with the same profile
        $db= mfSiteDatabase::getInstance();
        $db->setParameters(array('profile_id'=>$profile_id))
                ->setQuery(
                        "SELECT ".UserProfiles::getTableField('user_id')." FROM ".UserProfiles::getTable().
                        " WHERE ".UserProfiles::getTableField('user_id')." IN('".$selection->implode("','")."')". 
                        " AND ".UserProfiles::getTableField('profile_id')."='{profile_id}'".
                        ";"
                        )
                ->makeSiteSqlQuery($site);
        if ($db->getNumRows())
        {
            
            while ($row=$db->fetchArray()){                
                //unset($selection[array_search((int)$row['user_id'],$selection->toArray())]);
                $selection->findAndRemove((int)$row['user_id']);
            }
        } 
            foreach ($selection as $user_id)
            {
                $item=new UserProfiles(null,$site);
                $item->add(array('user_id'=>$user_id,'profile_id'=>$profile_id));
                $selection->findAndRemove();
                $collection[]=$item;
            } 
            $collection->save();
            $messages->push(__('Profiles has been changed.'));
        
        return $messages;
    }
}

