<?php

class UserProfileFunctionBase extends mfObject2 {
     
    const table="t_users_profile_function"; 
    protected static $fields=array('function_id','profile_id','created_at','updated_at');   
    protected static $foreignKeys=array('function_id'=>'UserFunction','profile_id'=>'UserProfile'); // By default
    
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
         if ($parameters instanceof UserProfile)
            return $this->loadByProfile ($parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);        
      }   
    }
        
       protected function loadByProfile(UserProfile $profile)
    {
              if ($profile->isNotLoaded())
              return $this;
         $this->set('profile_id',$profile);       
         $db=mfSiteDatabase::getInstance()
             ->setParameters(array('profile_id'=>$profile->get('id')))
             ->setQuery("SELECT * FROM ".self::getTable()." WHERE profile_id='{profile_id}';")
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
    
  /*  protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),'group_id'=>$this->get('group_id'),'function_id'=>$this->get('function_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable().
                    " WHERE name='{name}' AND name!='' AND group_id='{group_id}' AND function_id='{function_id}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   
    }*/
    
    function getFunction()
    {
       return $this->_function_id=$this->_function_id===null?new UserFunction($this->get('function_id'),$this->getSite()):$this->_function_id;
    }   
    
       function getProfile()
    {
        return $this->_profile_id=$this->_profile_id===null?new UserProfile($this->get('profile_id'),$this->getSite()):$this->_profile_id;
    }
}
