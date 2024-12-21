<?php

class Session extends mfObject2 {
    
    protected static $fields=array('session','ip','start_time','last_time', 
                                   //'is_last',
                                    'user_id');
    const table="t_sessions"; 
    protected static $foreignKeys=array('user_id'=>'User'); 
    
    function __construct($parameters=null,$application=null,$site=null) {
      parent::__construct($application,$site);
      if ($parameters===null) return $this; // Empty object comes from object creation / update partiallly
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          // DO NOTHING IN THIS CASE
      }   
      else
      {  
         if ($parameters instanceof User)
             return $this->loadLastSessionByUser($parameters);             
         return $this->loadBySession((string)$parameters);                    
      }   
    }
      
    
     protected function loadLastSessionByUser(User $user)
    {         
         $db=mfSiteDatabase::getInstance()->setParameters(array('user_id'=>$user->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable().
                       " WHERE user_id='{user_id}'".
                       " ORDER BY last_time DESC ".
                       " LIMIT 0,1".
                       ";");        
         $db->makeSiteSqlQuery($this->site);                              
         return $this->rowtoObject($db);
    }
    
    
     protected function loadBySession($session)
    {                  
         $this->set('session',$session);
         $db=mfSiteDatabase::getInstance()->setParameters(array('session'=>$session));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE session='{session}';");        
         $db->makeSqlQuery();                              
         return $this->rowtoObject($db);
    }
    
     protected function getDefaults()
     {
       $this->start_time=date("Y-m-d H:i:s");  
       $this->last_time=date("Y-m-d H:i:s");  
       $this->is_last='YES';
     }
     
     protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%s';")
            ->makeSiteSqlQuery();        
    }
    
    protected function executeInsertQuery($db)
    {
        $db->makeSiteSqlQuery(); 
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."='%s' ;")
           ->makeSiteSqlQuery(); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."='%s';")
           ->makeSiteSqlQuery();   
    }
     // GETTER
    
    function getUserId()
    {
        return $this->user_id;
    }
    
    function getIP()
    {
        return $this->ip;
    }
    
    function getLastTime()
    {
        return $this->last_time;
    }
    
    function getStartTime()
    {
        return $this->start_time;
    }
    
    // SETTERS
    function setSession($session)
    {
        $this->set('session',$session);
    }
    
    function setIP($ip)
    {
        $this->set('ip',$ip);
    }
    
    function setLastTime($last_time)
    {
        $this->set('last_time',$last_time);        
    }
    
    function setUser($user)
    {
        $this->set('user_id',$user->getId());
    }
    
    function getUser()
    {
        if ($this->_user_id===null)
        {
            
        }    
        return $this->_user_id;
    }
}

