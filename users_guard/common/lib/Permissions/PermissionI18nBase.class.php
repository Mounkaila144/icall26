<?php

class PermissionI18nBase extends mfObject2 {
     
    protected static $fields=array('value','permission_id','help',                                  
                                   'updated_at','created_at');
    protected static $foreignKeys=array('permission_id'=>'Permission',                                       
                                        ); // By default
    const table="t_permissions_i18n";
            
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);
      $this->getDefaults();
      if ($parameters===null) return $this; 
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
           
          
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            $this->loadbyId((string)$parameters);       
      }   
    }
   
     protected function loadByPermissionAndLang($permission_id,$lang)
    {
         $this->set('permission_id',$permission_id);
         $this->set('lang',$lang);
         $db=mfSiteDatabase::getInstance()->setParameters(array('lang'=>$lang,'permission_id'=>$permission_id));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE lang='{lang}' AND permission_id='{permission_id}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
   protected function executeLoadById($db)
   {
       $db->setQuery("SELECT * FROM ".self::getTable()." 
                      WHERE ".self::getKeyName()."=%d;")               
          ->makeSqlQuery($this->application,$this->site);
   }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d;")
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
       $db->setQuery("DELETE FROM ".self::getTable()." WHERE id=%d;") 
          ->makeSqlQuery($this->application,$this->site);     
    }
    
    protected function executeIsExistQuery($db)
     {     
      /*  $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
       $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND application@@IN_APPLICATION@@ ".$key_condition)
           ->makeSqlQuery($this->application,$this->site);         */
     }
     
       function getPermission()
     {
         if (!$this->_permission_id)
         {
             $this->_permission_id=new Permission($this->get('permission_id','admin',$this->getSite()));
         }   
         return $this->_permission_id;
     }
               
    
    public function __toString()
    {      
      return (string) $this->get('value');
    }
}
