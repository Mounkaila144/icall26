<?php

class UserTeamUsersBase extends mfObject2 {
     
    protected static $fields=array('user_id','team_id');
    protected static $foreignKeys=array('user_id'=>'User','team_id'=>'UserTeam'); 
    const table="t_users_team_users"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['team_id']) && isset($parameters['user']) && $parameters['user'] instanceof User)
             return $this->loadbyTeamIdAndUser($parameters['team_id'],$parameters['user']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);        
      }   
    }
    
    protected function loadbyTeamIdAndUser($team_id,User $user)     
    {
         $this->set('user_id',$user->get('id'));
         $this->set('team_id',$team_id);
         $db=mfSiteDatabase::getInstance()->setParameters(array('team_id'=>$team_id,'user_id'=>$user->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE user_id='{user_id}' AND team_id='{team_id}';")
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
        
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
        
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
    
    
    function getTeam()
    {
        return $this->_team_id=$this->_team_id===null? new UserTeam($this->get('team_id'),$this->getSite()):$this->_team_id;
    }
    
    function getUser()
    {
        return $this->_user_id=$this->_user_id===null? new User($this->get('user_id'),'admin',$this->getSite()):$this->_user_id;
    }
    
 /*   protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   
    }*/
       
       static function createTeamsForUser(User $user,mfArray $teams)
    {
       if ($user->isNotLoaded()) 
           return ;
       if (!$teams) 
           return ;       
       $team_collection=new UserTeamCollection(null,$user->getSite());
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".UserTeam::getTable().
                           " WHERE name IN('".$teams->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($user->getSite()); 
        if ($db->getNumRows())
        {
             while ($item=$db->fetchObject('UserTeam'))
            {          
                $team_collection[$item->get('id')]=$item->loaded()->setSite($user->getSite());
                $teams->findAndRemove($item->get('name'));
            }
            $team_collection->loaded();
        }   
        foreach ($teams as $team)
        {
            $item=new UserTeam(null,$user->getSite());
            $item->set('name',$team);
            $team_collection[]=$item;
        }    
        $team_collection->save();
        $team_user_collection=new UserTeamUsersCollection(null,$user->getSite());
        foreach ($team_collection as $team)
        {
            $item=new UserTeamUsers(null,$user->getSite());
            $item->add(array('user_id'=>$user,'team_id'=>$team));
            $team_user_collection[]=$item;
        }
        $team_user_collection->save();
    }  
            
}
