<?php

class DomoprimePolluterClassPricingBase extends mfObject2 {
     
    protected static $fields=array('polluter_id','class_id','coef','ana_prime','ite_prime','prime','pack_prime',
                                   'ite_coef','pack_coef','boiler_coef','ana_limit',
                                   'max_limit',
                                   'bbc_prime','strainer_prime',
                                   'bbc_article_prime','strainer_article_prime',
                                   'multiple','multiple_floor','multiple_top','multiple_wall','created_at','updated_at');
    const table="t_domoprime_polluter_class"; 
    protected static $fieldsNull=array('multiple_floor','multiple_top','multiple_wall','prime','pack_prime','ite_prime','ana_prime',);
    protected static $foreignKeys=array(
                                         'class_id'=>'DomoprimeClass',                                        
                                         'polluter_id'=>'DomoprimePollutingCompany',
                                         ); // By default
      
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {         
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
           if (isset($parameters['class']) && isset($parameters['polluter'])  && $parameters['class'] instanceof DomoprimeClass && $parameters['polluter'] instanceof PartnerPolluterCompany )
             return $this->loadbyClassAndPolluter($parameters['class'],$parameters['polluter']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);      
      }   
    }
    
    protected function loadbyClassAndPolluter($class,$polluter)
    {                       
         $db=mfSiteDatabase::getInstance()
             ->setParameters(array('class_id'=>$class->get('id'),'polluter_id'=>$polluter->get('id')))
             ->setQuery("SELECT * FROM ".self::getTable()." WHERE polluter_id='{polluter_id}' AND class_id='{class_id}';")
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
       $this->ite_coef=isset($this->ite_coef)?$this->ite_coef:0.0;
       $this->pack_coef=isset($this->pack_coef)?$this->pack_coef:0.0;
       $this->boiler_coef=isset($this->boiler_coef)?$this->boiler_coef:0.0;
       $this->ana_limit=isset($this->ana_limit)?$this->ana_limit:0.0;
       $this->multiple_floor=isset($this->multiple_floor)?$this->multiple_floort:0.0;
       $this->multiple_top=isset($this->multiple_top)?$this->multiple_top:0.0;
       $this->multiple_wall=isset($this->multiple_wall)?$this->multiple_wall:0.0;
       $this->prime=isset($this->prime)?$this->primet:0.0;       
       $this->pack_prime=isset($this->pack_limit)?$this->pack_limit:0.0;
       $this->ite_prime=isset($this->ite_limit)?$this->ite_limit:0.0;
       $this->prime=isset($this->prime)?$this->prime:0.0;
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
      $db->setParameters(array('class_id'=>$this->get('class_id'),'polluter_id'=>$this->get('polluter_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE class_id='{class_id}' AND polluter_id='{polluter_id}'  ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
   
       
     function getCoefficient()
     {
         return new mfFloat($this->get('coef'));
     }
     
       function getMultiple()
     {
         return new mfFloat($this->get('multiple'));
     }
     
  
     
     function getPolluter()
    {
        if ($this->_polluter_id===null)
        {
            $this->_polluter_id= new DomoprimePollutingCompany($this->get('polluter_id'),$this->getSite());
        }    
        return $this->_polluter_id;
    }
            
    
       function getClass()
    {
       if ($this->_class_id===null)
       {
          $this->_class_id=new DomoprimeClass($this->get('class_id'),$this->getSite());          
       }   
       return $this->_class_id;
    }  
     
    
    function toXML()
    {
        $values=parent::toArray();
        $values['class']=$this->getClass()->toXML();
        return $values;
    }
    
    function hasMultipleFloor()
    {
        return (boolean)$this->get('multiple_floor');
    }
    
     function hasMultipleTop()
    {
        return (boolean)$this->get('multiple_top');
    }
    
     function hasMultipleWall()
    {
        return (boolean)$this->get('multiple_wall');
    }
    
    function getAnaPrime()
    {
         return new FloatFormatter($this->get('ana_prime'));
    }
    
    function getITEPrime()
    {
        return new FloatFormatter($this->get('ite_prime'));
    }
    
    function getPackPrime()
    {
         return new FloatFormatter($this->get('pack_prime'));
    }
    
    function getBoilerPrime()
    {
         return new FloatFormatter($this->get('prime'));
    }
    
    function getBoilerCoef()
    {
        return new FloatFormatter($this->get('boiler_coef')); 
    }
    
    function getPackCoef()
    {
        return new FloatFormatter($this->get('pack_coef')); 
    }
    
    function getITECoef()
    {
        return new FloatFormatter($this->get('ite_coef')); 
    }
    
    function getAnaLimit()
    {
        return new FloatFormatter($this->get('ana_limit')); 
    }
    
    function getMaxLimit()
    {
      return new FloatFormatter($this->get('max_limit'));           
    }
    
    function hasMaxLimit()
    {
        return (boolean) $this->get('max_limit');
    }
    
 
    function getPassoireArticlePrime()
    {
        return new FloatFormatter($this->get('strainer_article_prime'));           
    }
    
    function getBBCArticlePrime()
    {
        return new FloatFormatter($this->get('bbc_article_prime'));           
    }
}
