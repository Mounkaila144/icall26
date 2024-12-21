<?php

class UserLogoutRequestBase extends mfObject2 {
     
    protected static $fields=array('logout','user_id','session_id','updated_at','created_at');
    protected static $foreignKeys=array('user_id'=>'User','session_id'=>'Session'); // By default
    const table="t_users_logout_request"; 
    
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
         {
            return $this->loadbyUser($parameters);    
         }            
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);       
      }   
    }       
    
    protected function loadByUser(User $user)
    {         
        $this->set('user_id',$user);
         $db=mfSiteDatabase::getInstance()
               ->setParameters(array('user_id'=>$user->get('id')))
               ->setQuery("SELECT * FROM ".self::getTable().
                       " WHERE user_id='{user_id}'".
                       " ORDER BY id DESC".
                       " LIMIT 0,1".
                       ";")
            ->makeSiteSqlQuery($this->getSite());                           
         return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->getSite());  
    }
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");   
        $this->logout=isset($this->logout)?$this->logout:"YES";   
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->getSite());   
    }
    
    function getValuesForUpdate()
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->getSite()); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->getSite());   
    }
    
   
    
     function getUser()
    {
       if (!$this->_user_id)
       {
          $this->_user_id=new User($this->get('user_id'),'admin',$this->getSite());          
       }   
       return $this->_user_id;
    }       
    
    
    function getSession()
    {
       if (!$this->_session_id)
       {
          $this->_session_id=new Session($this->get('session_id'),$this->getSite());          
       }   
       return $this->_session_id;
    }   
     
    function isLogoutRequested()
    {
        if ($this->isNotLoaded() || $this->get('logout')=='LOGOUT')
        {                
            return false;
        }           
        $this->set('logout','LOGOUT');
        $this->save();
        return true;
    }
    
    function logout()
    {
        $this->set('logout','YES');
        $session=new Session($this->getUser());        
        if ($session->isLoaded())
        {          
          $this->set('session_id',$session->get('id'));
          $this->save();
        }
        return $this;
    }
    
       
}
