<?php

class UserProfileUtilsBase  {
     
     
    
    static function migrateAdminWithPermissions($site=null)
    {
                                                        
    }   
    
   /* static function getFunctionsAndGroupsWithPermissionsForProfile($profile)
    {
        if ($groups === null)
        {
            $groups=new GroupCollection(null,$profile->getSite()); 
            if ($profile->isNotLoaded())
                return $groups;
            $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('profile_id'=>$profile->get('id')))
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
                 ->makeSiteSqlQuery($profile->getSite());   
                //echo $db->getQuery();
            if (!$db->getNumRows())
                return $groups;
          
            while ($items=$db->fetchObjects())
            {                 
                if(!isset($groups[$items->getGroup()->get('id')])){
                    $groups[$items->getGroup()->get('id')]=$items->getGroup()->loaded()->setSite($profile->getSite()) ;
                    $groups[$items->getGroup()->get('id')]->profile=$items->getUserProfile()->loaded()->setSite($profile->getSite()) ;
                }
               $groups[$items->getGroup()->get('id')]->getPermissionsList()->push($items->getPermission());                        
               $groups[$items->getGroup()->get('id')]->getFunctions()->push($items->getUserFunction()->setI18n($items->getUserFunctionI18n()));
            }     
            $groups->loaded();
        }
        return $groups;
    }*/
    
    static function getProfilesExceptedForSelect(UserProfile $excepted_profile)
    {
        
        $list=new mfArray();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getCountry(),'excepted_id'=>$excepted_profile->get('id')))
                ->setQuery("SELECT ".UserProfileI18n::getFieldsAndKeyWithTable()." FROM ".UserProfile::getTable().
                        " INNER JOIN ".UserProfileI18n::getInnerForJoin('profile_id')." AND lang='{lang}'". 
                        " WHERE ".UserProfile::getTableField('id')."!='{excepted_id}'".
                        " GROUP BY ".UserProfile::getTableField('id').
                        " ORDER BY ".UserProfileI18n::getTableField('value')." COLLATE UTF8_GENERAL_CI ASC ".
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
    
    static function getProfilesByValues(mfArray $values,$site=null)
    {
        $list=new UserProfileCollection();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=> mfContext::getInstance()->getUser()->getLanguage()))
                ->setQuery("SELECT ".UserProfile::getFieldsAndKeyWithTable()." FROM ".UserProfile::getTable().
                        " INNER JOIN ".UserProfileI18n::getInnerForJoin('profile_id')." AND lang='{lang}'". 
                        " WHERE ".UserProfileI18n::getTableField('value')." IN('".$values->implode("','")."')".                      
                        ";")               
                ->makeSiteSqlQuery($site);
     //   echo $db->getQuery();
        if (!$db->getNumRows())
            return $list;        
        while ($item=$db->fetchObject('UserProfile'))
        { 
            $list[$item->get('id')]=$item->setSite($site)->loaded();
        }            
        return $list;                 
    }
    
    static function getUsersByProfiles(UserProfileCollection $selection,$site=null)
    {              
         $list=new mfArray();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().
                        " INNER JOIN ".UserGroup::getInnerForJoin('user_id').
                        " INNER JOIN ".UserGroup::getOuterForJoin('group_id').                        
                        " INNER JOIN ".UserProfileGroup::getInnerForJoin('group_id').                        
                        " INNER JOIN ".UserProfiles::getInnerForJoin('user_id')." AND ".UserProfiles::getTableField('profile_id')."=".UserProfileGroup::getTableField('profile_id').                                                
                        " WHERE ".UserProfiles::getTableField('profile_id')." IN('".$selection->getKeys()->implode("','")."')".  
                             //   " AND ".User::getTableField('is_active')."='YES'".
                              //  " AND ".User::getTableField('status')."='ACTIVE'".                                
                        " GROUP BY ".User::getTableField('id').
                        ";")               
                ->makeSiteSqlQuery($site);
       // echo $db->getQuery();       die(__METHOD__);
        if (!$db->getNumRows())
            return $list;        
        while ($item=$db->fetchObject('User'))
        { 
            $list[$item->get('id')]=$item->loaded();
        }            
        return $list;         
    }
    
   static function getNumberOfProfiles($site=null)
    {                       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT count(".UserProfile::getTableField('id').") FROM ".UserProfile::getTable().
                           " INNER JOIN ".UserProfiles::getInnerForJoin('profile_id').                                  
                        ";")               
                ->makeSiteSqlQuery($site);
       // echo $db->getQuery();       die(__METHOD__);
        $row=$db->fetchRow();                  
        return (int)$row[0];         
    }
    
    
    static function getUsersWithoutProfiles($site=null)
    {
        $list=new mfArray();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".User::getTable().                             
                        " LEFT JOIN ".UserProfiles::getInnerForJoin('user_id').                                                
                        " WHERE ".UserProfiles::getTableField('id')." IS NULL".    
                        " GROUP BY ".User::getTableField('id').               
                        ";")               
                ->makeSiteSqlQuery($site);
       // echo $db->getQuery();       die(__METHOD__);
        if (!$db->getNumRows())
            return $list;        
        while ($item=$db->fetchObject('User'))
        { 
            $list[$item->get('id')]=$item->loaded();
        }            
        return $list;                    
    }        
}
