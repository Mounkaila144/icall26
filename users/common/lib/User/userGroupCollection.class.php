<?php

class UserGroupCollection extends mfObjectCollection2 {
    
    function __construct($data=null,$site=null) {
        if ($data instanceof UserProfile)
        {            
            parent::__construct(null,null, $site);
            $this->data=$data;
            return $this;
        }   
        parent::__construct($data, null, $site);
    }
    
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT ".$this->getTableKey().",user_id FROM ".$this->getTable().
                      " LEFT JOIN ".Group::getTable()." ON ".Group::getTableKey()."=group_id".
                      " WHERE ".$this->getWhereConditions()." AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site);     
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
            ->makeSiteSqlQuery($this->site); 
    }
    
    
    function getGroups()
    {
        if ($this->groups===null)
        {    
            $selection = new mfArray();
            foreach ($this as $item)        
                $selection->push($item->get('group_id'));        
             $this->groups= GroupUtils::getGroupsFromSelection($selection,$this->getSite());
        }
        return $this->groups;
    }
    
    
    function delete()
    {
        if ($this->data instanceof UserProfile)
        {
               if ($this->data->isNotLoaded())
                    return $this;                 
                $db=mfSiteDatabase::getInstance();
                        $db->setParameters(array('profile_id'=>$this->data->get('id')))
                        ->setQuery("DELETE ".UserGroup::getTable()." FROM ".UserGroup::getTable().
                                   " INNER JOIN ".UserProfiles::getTable()." ON ".UserProfiles::getTableField('user_id')."=".UserGroup::getTableField('user_id').                            
                                   " WHERE ".UserProfiles::getTableField('profile_id')."='{profile_id}'".
                                   ";") 
                        ->makeSqlQuery();        
               return $this;           
        }
        return $this;
    }
    
    function addUserGroupsForProfile()
    {
        if ($this->data instanceof UserProfile)
        {
               if ($this->data->isNotLoaded())
                    return $this;         
                $db=mfSiteDatabase::getInstance();
               $db->setParameters(array('profile_id'=>$this->data->get('id')))
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
               $user_groups->save();
        }   
        return $this;
    }
}

