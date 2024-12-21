<?php

class UserTeamBase extends mfObject2 {
     
    protected static $fields=array('name','manager_id', 'manager2_id',
                                   'created_at','updated_at');
    const table="t_users_team"; 
    protected static $foreignKeys=array('manager_id'=>'User','manager2_id'=>'User'); // By default
    
    
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
        else return $this->loadbyName((string)$parameters);  
      }   
    }
    
    protected function loadByName($name)
    {
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()->setParameters(array($name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s';")
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
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   
    }
    
    function getUsers(){
        
        if ($this->users===null) 
        {    
            $this->users=new UserCollection(null, $this->getSite());            
            $db=mfSiteDatabase::getInstance()                     
                ->setParameters(array('team_id'=>$this->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".UserTeamUsers::getTable().
                           " LEFT JOIN ".UserTeamUsers::getOuterForJoin('user_id').
                           " WHERE team_id={team_id}".
                           ";")                            
                ->makeSiteSqlQuery($this->getSite()); 
            if (!$db->getNumRows())
                return $this->users;
            while ($item=$db->fetchObject('User'))
            {            
               $this->users[$item->get('id')]=$item;
            }
        }
        return $this->users;
    }
     
    function hasManager()
    {
        return (boolean)$this->get('manager_id');
    }
    
    function getManager()
    {
        if (!$this->_manager_id)
        {
            $this->_manager_id=new User($this->get('manager_id'),'admin',$this->getSite());
        }   
        return $this->_manager_id;
    }
    
    function hasManager2()
    {
        return (boolean)$this->get('manager2_id');
    }
    
    function getManager2()
    {
        if (!$this->_manager2_id)
        {
            $this->_manager2_id=new User($this->get('manager2_id'),'admin',$this->getSite());
        }   
        return $this->_manager2_id;
    }
    
     function getUsersById()
    {       
        if ($this->isNotLoaded())
            return array();
        $users=array();       
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('team_id'=>$this->get('id')))
                ->setQuery("SELECT ".User::getTableField('id')." FROM ".UserTeamUsers::getTable().
                           " LEFT JOIN ".UserTeamUsers::getOuterForJoin('user_id').
                           " WHERE team_id={team_id}".
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
        if (!$db->getNumRows())
            return $users;
        while ($row=$db->fetchArray())
        {            
            $users[]=$row['id'];
        }      
        return $users;
    
    }
    
    function updateUsers($users)
    {
        if ($this->isNotLoaded())
            return $this;      
        // Remove unused users
       
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('team_id'=>$this->get('id')))
            ->setQuery("DELETE FROM ".UserTeamUsers::getTable().                       
                       " WHERE user_id NOT IN('".implode("','",$users)."') AND team_id={team_id}".
                       ";")
            ->makeSiteSqlQuery($this->getSite()); 
        
        
        
        
        // Add users for team
     /*   $collection=new UserTeamUsersCollection(null,$this->getSite());
        foreach ($users as $user)
        {            
            $user_team_users=new UserTeamUsers(null,$this->getSite()); 
            $user_team_users->add(array('user_id'=>$user,'team_id'=>$this));
            $collection[]=$user_team_users;
        }    
        $collection->save();
        return $this;*/
        
        // get existing 
        $db->setParameters(array('team_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".UserTeamUsers::getTable()." WHERE team_id={team_id};")
                 ->makeSiteSqlQuery($this->getSite());
        $collection=new UserTeamUsersCollection(null,$this->getSite());
        if ($db->getNumRows())
        {      
            while ($item=$db->fetchObject('UserTeamUsers'))
            {                                   
               $collection[]=$item->loaded();
               if (($key=array_search($item->get('user_id'),$users))!==false)
                  unset($users[$key]);               
            }     
        }         
        // Add new user groups        
        foreach ($users as $id)
        {
            $user_team_user=new UserTeamUsers(null,$this->getSite()); 
            $user_team_user->add(array('user_id'=>$id,'team_id'=>$this));
            $collection[]=$user_team_user;
        }    
        $collection->save();       
        return $this;
    }
    
    function __toString() {
        return (string)$this->get('name');
    }
    
     function toArrayForTransfer()
    {
        $values=array();
        foreach (array('name') as $field)
            $values[$field]=$this->get($field);        
        return $values;
    }
    
    function save()
     {
         parent::save();
         mfCacheFile::removeCache('users.teams','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('users.teams','admin',$this->getSite());         
         return $this;
     }
}
