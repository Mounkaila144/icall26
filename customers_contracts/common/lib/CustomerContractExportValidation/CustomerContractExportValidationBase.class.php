<?php

 
class CustomerContractExportValidationBase extends mfObject3 {
   
    protected static $fields=array('token','user_id','created_at','updated_at');
    const table="t_customers_contracts_export_validation"; 
     protected static $foreignKeys=array('user_id'=>'User'); // By default
    
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
       //  if ($parameters instanceof User)
       //     return $this->loadByUser($parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);         
      }   
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
    
   /* protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE  name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
    
     protected function loadbyUser(User $user)
    {             
         $this->set('user_id',$user);        
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$user->get('id')))
                ->setQuery("SELECT * FROM ".self::getTable().                                       
                           " WHERE user_id='{user_id}' ".
                           ";")
                ->makeSiteSqlQuery($this->getSite());         
         return $this->rowtoObject($db);        
    }   
    
    function cleanUp()
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('user_id'=>$this->get('user_id')))
                ->setQuery("DELETE FROM ".self::getTable().                                       
                           " WHERE user_id='{user_id}' ".
                           ";")
                ->makeSiteSqlQuery($this->getSite()); 
        return $this;
    }
    
    function create(User $user)
    {
        $this->cleanUp();
        $this->set('token',mfTools::generatePassword(64));  
        $this->set('user_id',$user);        
        return $this->save();
    }
    
}
