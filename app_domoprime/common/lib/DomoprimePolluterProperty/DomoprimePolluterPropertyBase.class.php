<?php

class DomoprimePolluterPropertyBase extends mfObject2 {
    
    protected static $fields=array('prime','ite_prime','ana_prime','pack_prime','home_prime','polluter_id','created_at','updated_at');
    const table="t_domoprime_polluter_property"; 
       protected static $foreignKeys=array('polluter_id'=>'PartnerPolluterCompany'); // By default
    
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
          if ($parameters instanceof PartnerPolluterCompany) 
            return $this->loadbyPolluter($parameters); 
           if ($parameters instanceof DomoprimePollutingCompany) 
            return $this->loadbyPolluter($parameters); 
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters); 
        
      }   
    }
    
    protected function loadByPolluter($polluter)
    {
         $this->set('polluter_id',$polluter);
         $db=mfSiteDatabase::getInstance()->setParameters(array('polluter_id'=>$polluter->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE polluter_id='{polluter_id}';")
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
    
   /* protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
    function getCompany()
    {
        return $this->_company_id=$this->_company_id===null?new PartnerPolluterCompany($this->get('company_id'),$this->getSite()):$this->_company_id;
    }
   
    function getPrime()
    {
        return new FloatFormatter($this->get('prime'));
    }
    
      function getPackPrime()
    {
        return new FloatFormatter($this->get('pack_prime'));
    }
      
    function getAnaPrime()
    {
         return new FloatFormatter($this->get('ana_prime'));
    }
    
    function getITEPrime()
    {
        return new FloatFormatter($this->get('ite_prime'));
    }
    
     function getHomePrime()
    {
        return new FloatFormatter($this->get('home_prime'));
    }
    
     function toXML()
     {
        $values= parent::toArray();      
        return $values;
     }         
     
      function getPolluter()
     {
         return $this->_polluter_id=$this->_polluter_id===null?new PartnerPolluterCompany($this->get('polluter_id')):$this->_polluter_id;
     }
}
