<?php

class UserGroup extends mfObject2 {
    
    protected static $fields=array('user_id','group_id',
                                //'created_at','updated_at',
                                   'is_active');
    const table="t_user_group";    
    protected static $foreignKeys=array('user_id'=>'User','group_id'=>'Group');
    
    function __construct($parameters=null, $site=null) {
        parent::__construct(null, $site);
        $this->getDefaults();
        if ($parameters === null) return $this;
        if (is_array($parameters)) {
            if (isset($parameters['id']))
                return $this->loadbyId($parameters['id']);
             if (isset($parameters['user']) && isset($parameters['group']) && $parameters['user'] instanceof User && $parameters['group'] instanceof Group)
                return $this->loadbyUserAndGroup($parameters['user'],$parameters['group']);
            return $this->add($parameters);
        }
        else {
            if (is_numeric($parameters))
                return $this->loadbyId($parameters);
          //  return $this->loadbyName((string)$parameters); 
        }
    }
      
    protected function loadbyUserAndGroup($user,$group)
    {
         $this->set('user_id',$user);
         $this->set('group_id',$group);
         $db=mfSiteDatabase::getInstance()->setParameters(array('user_id'=>$user->get('id'),'group_id'=>$group->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE user_id='{user_id}' AND group_id='{group_id}';")
             ->makeSiteSqlQuery($this->site);                          
         return $this->rowtoObject($db);
    }        
   /* protected function loadByName($name)
    {
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()->setParameters(array($name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s' AND application@@IN_APPLICATION@@;")
             ->makeSqlQuery($this->application,$this->site);                          
         return $this->rowtoObject($db);
    }*/
    
     protected function executeLoadById($db)
    {
         $db->setQuery("SELECT  ".self::getFieldsAndKeyWithTable()."  FROM ".self::getTable().
                       " LEFT JOIN ".User::getTable()." ON ".User::getTableKey()."=user_id".
                       " WHERE ".self::getTableKey()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->is_active=isset($this->is_active)?$this->is_active:"NO";
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
     
    
    function getGroup()
    {
        return $this->_group_id=$this->_group_id===null?new Group($this->get('group_id'),$this->getUser()->get('application'),$this->getSite()):$this->_group_id;
    }
    
     function getUser()
    {
        return $this->_user_id=$this->_user_id===null?new User($this->get('user_id'),null,$this->getSite()):$this->_user_id;
    }
}

