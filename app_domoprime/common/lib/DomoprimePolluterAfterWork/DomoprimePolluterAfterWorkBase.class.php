<?php

class DomoprimePolluterAfterWorkBase extends mfObject2 {
     
    protected static $fields=array('model_id','polluter_id','created_at','updated_at');
    
    const table="t_partner_polluter_after_work"; 
       protected static $foreignKeys=array('model_id'=>'DomoprimeAfterWorkModel',                                           
                                           'polluter_id'=>'PartnerPolluterCompany'
                                        ); // By default   
      protected static $fieldsNull=array('model_id','polluter_id');
      
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
         if ($parameters instanceof PartnerPolluterCompany || $parameters instanceof DomoprimePollutingCompany)
           return $this->loadByPolluter($parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
      }   
    }       
    
     protected function loadbyPolluter($polluter)
    {
         $this->set('polluter_id',$polluter);
         $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('polluter_id'=>$polluter->get('id')))                                      
                    ->setQuery("SELECT * FROM ".self::getTable()." WHERE polluter_id='{polluter_id}';")
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
      $db->setParameters(array('name'=>$this->get('name'),'polluter_id'=>$this->get('polluter_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE polluter_id='{polluter_id}' AND name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
   
           
    function getModel()
    {
       if (!$this->_model_id)
       {
          $this->_model_id=new DomoprimeAfterWorkModel($this->get('model_id'),$this->getSite());          
       }   
       return $this->_model_id;
    }   
    
    
      function getPolluter()
    {
       if (!$this->_polluter_id)
       {
          $this->_polluter_id=new PartnerPolluterCompany($this->get('polluter_id'),$this->getSite());          
       }   
       return $this->_polluter_id;
    }   
    
    
   
}
