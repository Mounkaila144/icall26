<?php

class UserPropertiesBase extends mfObject2 {
    
    protected static $fields=array( 
                    'user_id','name',
                    'created_at','updated_at',
                    'is_active'
    );
    const table="t_user_properties";    
    protected static $foreignKeys=array('user_id'=>'User');
    
    function __construct($parameters=null, $site=null) {
        
        parent::__construct(null, $site);
        $this->getDefaults();
        if ($parameters === null) return $this;
        if (is_array($parameters)) {
            if (isset($parameters['id']))
                return $this->loadbyId($parameters['id']);
             if (isset($parameters['user'])  && $parameters['user'] instanceof User )
                return $this->loadbyUser($parameters['user'],$parameters['group']);
            return $this->add($parameters);
        }
        else {
            if (is_numeric($parameters))
                return $this->loadbyId($parameters);
          //  return $this->loadbyName((string)$parameters); 
        }
    }
      
    protected function loadbyUserAndName($user,$name)
    {
         $this->set('user_id',$user);
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()->setParameters(array('user_id'=>$user->get('id'),'name'=>$name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE user_id='{user_id}' AND name='{name}';")
             ->makeSiteSqlQuery($this->site);                          
         return $this->rowtoObject($db);
    }
    
    protected function loadByName($name)
    {
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()->setParameters(array($name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s' AND application@@IN_APPLICATION@@;")
             ->makeSqlQuery($this->application,$this->site);                          
         return $this->rowtoObject($db);
    }
    
     protected function executeLoadById($db)
    {
         $db->setQuery("SELECT  ".self::getFieldsAndKeyWithTable()."  FROM ".self::getTable().
                       " LEFT JOIN ".User::getTable()." ON ".User::getTableKey()."=user_id".
                       " WHERE ".self::getTableKey()."=%d;")
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
     
    function getUser()
    {
        return $this->_user_id=$this->_user_id===null?new User($this->get('user_id'),null,$this->getSite()):$this->_user_id;
    }

}

