<?php

class UserProfilesBase extends mfObject2 {
     
    const table="t_users_profiles"; 
    protected static $fields=array('user_id','profile_id','created_at','updated_at');   
    protected static $foreignKeys=array('user_id'=>'User','profile_id'=>'UserProfile'); // By default
    
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
          if ($parameters instanceof User)
             return $this->loadbyUser($parameters);     
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);        
      }   
    }

    protected function loadByUser(User $user)
    {
         $this->set('user_id',$user);       
         $db=mfSiteDatabase::getInstance()->setParameters(array('user_id'=>$user->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE user_id='{user_id}';")
             ->makeSiteSqlQuery($this->site);                          
         return $this->rowtoObject($db);
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
   /*   $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   */   
    }
    
    function getProfile()
    {
       return $this->_profile_id=$this->_profile_id===null?new UserProfile($this->get('profile_id'),$this->getSite()):$this->_profile_id;
    }   
    
      function getUser()
    {
       return $this->_user_id=$this->_user_id===null?new User($this->get('user_id'),'admin',$this->getSite()):$this->_user_id;
    }   
        
     function setProfile(UserProfile $profile)
     {
         $this->set('profile_id',$profile);
         return $this;
     }
     
     function updateGroupsForUser()
     {
        $db=mfSiteDatabase::getInstance();
         $groups= $this->getProfile()->getGroups()->getGroups();
                  
         if ($groups->isEmpty())
         {
             $db->setParameters(array('user_id'=>$this->get('user_id')))
                 ->setQuery("DELETE FROM ".UserGroup::getTable()." WHERE user_id='{user_id}';")
                 ->makeSiteSqlQuery($this->site);  
             return ;
         }    
         $db->setParameters(array('user_id'=>$this->get('user_id')))
                 ->setQuery("DELETE FROM ".UserGroup::getTable()." WHERE group_id NOT IN('".$groups->implode("','")."') AND user_id='{user_id}';")
                 ->makeSiteSqlQuery($this->site);   
         $db->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("SELECT group_id FROM ".UserGroup::getTable()." WHERE user_id='{user_id}';")
                 ->makeSiteSqlQuery($this->site);              
        if ($db->getNumRows())
        {      
            while ($row=$db->fetchRow())
            {                                                  
               $groups->findAndRemove($row[0]);         
            }      
        }  
        $collection=new UserGroupCollection(null,$this->getSite());  
        foreach ($groups as $id)
        {
            $item= new UserGroup(null,$this->getSite());
            $item->add(array('user_id'=>$this->get('user_id'),'is_active'=>'YES','group_id'=>$id));
            $collection[]=$item;
        }        
        $collection->save(); 
     }
     
     function updateFunctionsForUser()
     {
         $db=mfSiteDatabase::getInstance();
         $functions= $this->getProfile()->getFunctions()->getFunctions();
         if ($functions->isEmpty())
         {
             $db->setParameters(array('user_id'=>$this->get('user_id')))
                 ->setQuery("DELETE FROM ".UserFunctions::getTable()." WHERE user_id='{user_id}';")
                 ->makeSiteSqlQuery($this->site);  
             return ;
         }    
         $db->setParameters(array('user_id'=>$this->get('user_id')))
                 ->setQuery("DELETE FROM ".UserFunctions::getTable()." WHERE function_id NOT IN('".$functions->implode("','")."') AND user_id='{user_id}';")
                 ->makeSiteSqlQuery($this->site);   
         $db->setParameters(array('user_id'=>$this->get('id')))
                 ->setQuery("SELECT function_id FROM ".UserFunctions::getTable()." WHERE user_id='{user_id}';")
                 ->makeSiteSqlQuery($this->site);              
        if ($db->getNumRows())
        {      
            while ($row=$db->fetchRow())
            {                                                  
               $functions->findAndRemove($row[0]);         
            }      
        }  
        $collection=new UserFunctionsCollection(null,$this->getSite());  
        foreach ($functions as $id)
        {
            $item= new UserFunctions(null,$this->getSite());
            $item->add(array('user_id'=>$this->get('user_id'),'function_id'=>$id));
            $collection[]=$item;
        }        
        $collection->save();        
     }
     
     function save()
     {      
         if ($this->isNotLoaded() || $this->hasPropertyChanged('profile_id'))
         {                   
             $this->updateFunctionsForUser();
             $this->updateGroupsForUser();
         }
         return parent::save();
     }
     
     
     
        
}
