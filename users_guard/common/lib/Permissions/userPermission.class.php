<?php

class UserPermission extends mfObject2 {
    
     protected static $fields=array('permission_id','user_id',
                                     'created_at','updated_at'
                                    );
     protected static $foreignKeys=array('permission_id'=>'Permission','user_id'=>'User');
     
     const table="t_user_permission";    
     
     function __construct($parameters=null,$site=null) {
        parent::__construct(null, $site);
        $this->getDefaults();
        if ($parameters === null) return $this;
        if (is_array($parameters)||$parameters instanceof ArrayAccess) {
            if (isset($parameters['id']))
                return $this->loadbyId((string)$parameters['id']);
            return $this->add($parameters);
        }
        else {
            if (is_numeric((string)$parameters))
                $this->loadbyId((string)$parameters);
        }   
    }
    
    protected function executeLoadById($db)
    {
            $db->setQuery("SELECT ".self::getTableKey().",user_id,permission_id 
                       FROM ".self::getTable()."
                       LEFT JOIN ".Permission::getTable()." ON ".Permission::getTableKey()."=".self::getTable().".permission_id
                       WHERE ".self::getTableKey()."=%d;")   
            ->makeSiteSqlQuery($this->site); 
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
    
     function getPermission()
     {
         if (!$this->_permission_id)
         {
             $this->_permission_id=new Permission($this->get('permission_id',$this->getSite()));
         }   
         return $this->_permission_id;
     }
     
     function getUser()
     {
         return $this->_user_id=$this->_user_id===null?new User($this->get('user_id'),'admin',$this->getSite()):$this->_user_id;
     }
      
      protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");      
    }
    
     function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    } 
}

