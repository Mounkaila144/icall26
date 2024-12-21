<?php

class UserProfileGroupOptimizationEngine {
    
    function __construct(UserProfile $profile,$user) {
        $this->profile=$profile;
        $this->user=$user;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getProfile()
    {
        return $this->profile;
    }
    
    function process()
    {
        // 1 - new group    Group     
        $group = new Group();
        $group->add(array('name'=>(string)$this->getProfile()->getI18n()."-".date("Y-m-d h:i"),'is_active'=>'YES'))
              ->save();
        
        // 2 - permissions des groupes du profil       
        // 3 - affectation permission sur nouveau groupe
        $group->addPermissions($this->getProfile()->getPermissions());
        
        
        $this->getProfile()->getUserGroups()->delete();
        
          // user group  
     /*   $db=mfSiteDatabase::getInstance();
                 $db->setParameters(array('profile_id'=>$this->getProfile()->get('id')))
                 ->setQuery("DELETE ".UserGroup::getTable()." FROM ".UserGroup::getTable().
                            " INNER JOIN ".UserProfiles::getTable()." ON ".UserProfiles::getTableField('user_id')."=".UserGroup::getTableField('user_id').                            
                            " WHERE ".UserProfiles::getTableField('profile_id')."='{profile_id}'".
                            ";") 
                 ->makeSqlQuery();*/
        
        // 4 - supprime des anciens groupe du profile
        $this->getProfile()->getGroups()->delete();                          
        
        
        // 5 - affecte le nouveau au profile
        $user_profil_group= new UserProfileGroup();
        $user_profil_group->add(array('group_id'=>$group->get('id'),"profile_id"=>$this->getProfile()));
        $user_profil_group->save();
        
        $this->getProfile()->getUserGroups()->addUserGroupsForProfile();
        
       /* $db->setParameters(array('profile_id'=>$this->getProfile()->get('id')))
                 ->setQuery("SELECT ".User::getTableField('id').",".UserProfileGroup::getTableField('group_id')."  FROM ".User::getTable().
                            " INNER JOIN ".UserProfiles::getInnerForJoin('user_id'). 
                            " INNER JOIN ".UserProfileGroup::getTable()." ON " .UserProfileGroup::getTableField('profile_id')."=". UserProfiles::getTaBleField('profile_id').                                                            
                            " LEFT JOIN ".UserGroup::getTable()." ON ". UserGroup::getTableField('group_id')."=".UserProfileGroup::getTableField('group_id')." AND ".UserGroup::getTableField('user_id')."=".User::getTableField('id').                                                                                                                             
                            " WHERE ".UserProfiles::getTableField('profile_id')."='{profile_id}' AND ".UserGroup::getTableField('id')." IS NULL ".
                            ";")
                 ->makeSqlQuery();      
      //  echo $db->getQuery();
        if (!$db->getNumRows())
             return ;      
        $user_groups=new UserGroupCollection();
        while ($row=$db->fetchArray())
        {         
            $item=new UserGroup();
            $item->add(array('user_id'=>$row['id'],'is_active'=>'YES','group_id'=>$row['group_id']));
            $user_groups[]=$item;
        }       
        $user_groups->save();*/
        return $this;
    }
}
