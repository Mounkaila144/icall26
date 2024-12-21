<?php

class Permission extends mfObject2 {
     
    protected static $fields=array('name','application','group_id',                                  
                                   'updated_at','created_at');
    protected static $foreignKeys=array('group_id'=>'PermissionGroup',                                        
                                        ); // By default
    const table="t_permissions";
            
    function __construct($parameters=null,$application=null,$site=null) {
      parent::__construct($application,$site);
      $this->getDefaults();
      if ($parameters===null) return $this; 
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['name']))
             return $this->loadbyName((string)$parameters['name']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            $this->loadbyId((string)$parameters);
         else
           $this->loadbyName((string)$parameters);  
      }   
    }
   
     protected function loadByName($name)
    {
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('app'=>$this->get('application'),$name))
                 ->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s' AND application='{app}';")
                 ->makeSiteSqlQuery($this->site);          
         return $this->rowtoObject($db);
    }
      
   protected function executeLoadById($db)
   {
       $db->setQuery("SELECT * FROM ".self::getTable()." 
                      WHERE ".self::getKeyName()."=%d AND application@@IN_APPLICATION@@;")               
          ->makeSqlQuery($this->application,$this->site);
   }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d AND application@@IN_APPLICATION@@;")
          ->makeSqlQuery($this->application,$this->site);
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
    }   
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuery($this->application,$this->site);
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setQuery("DELETE FROM ".self::getTable()." WHERE id=%d AND application@@IN_APPLICATION@@ ;") 
          ->makeSqlQuery($this->application,$this->site);     
    }
    
    protected function executeIsExistQuery($db)
     {
      /*  $parameters=array($this->name);
        if ($this->id)
        {
           $parameters[]=$this->id;
           $query="SELECT id FROM ".self::getTable()." WHERE t_permissions.name='%s' AND id!=%d AND application@@IN_APPLICATION@@;";               
        }
        else
        {
           $query="SELECT id FROM ".self::getTable()." WHERE t_permissions.name='%s' AND application@@IN_APPLICATION@@;";
        }    */
       $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
       $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND application@@IN_APPLICATION@@ ".$key_condition)
           ->makeSqlQuery($this->application,$this->site);        
     }
     
       function getGroup()
     {
         if (!$this->_group_id)
         {
             $this->_group_id=new PermissionGroup($this->get('group_id',$this->getSite()));
         }   
         return $this->_group_id;
     }
     
      
    // GETTER    
    function getId()
    {
        return $this->id;        
    }
    
    function getName()
    {
        return $this->name;
    }
    
    //
    
    public function __toString()
  {      
    return (string) $this->name;
  }
  
    function getI18n()
    {       
        return __($this->get('name'),array(),'permissions','users_guard');       
    }
    
    function isSuperAdmin()
    {
        return stripos($this->get('name'),'superadmin')!==false;
    }
}
