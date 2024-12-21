<?php

class CustomerCommentBase extends mfObject2 {
     
    protected static $fields=array('customer_id','comment','updated_at','created_at');    
    const table="t_customers_comments"; 
    protected static $foreignKeys=array('customer_id'=>'Customer'); // By default
         
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
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
        // return $this->loadBySms((string)$parameters);
      }   
    }
    
  /*  protected function loadBySms($sms)
    {
         $this->set('sms',$sms);
         $db=mfSiteDatabase::getInstance()->setParameters(array($sms));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE sms='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
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
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function setHistory($user)
    {
        $history=new CustomerCommentHistory(null,$this->getSite());
        $history->setUser($user);
        $history->setComment($this);
        $history->save();
    }
   
    function getCustomer()
    {
        if ($this->_customer_id===null)
        {
            $this->_customer_id=new Customer($this->get('customer_id'),$this->getSite());
        }   
        return $this->_customer_id;
    }
    
     function getSettings()
    {
        return $this->settings=$this->settings===null?new CustomerCommentSettings(null,$this->getSite()):$this->settings;
    }
           
    function getCensoredText()
    {
        return $this->getSettings()->escapeText($this->get('comment'));
    }
}
