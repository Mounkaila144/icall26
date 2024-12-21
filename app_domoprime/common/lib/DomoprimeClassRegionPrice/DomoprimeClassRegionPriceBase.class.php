<?php


class DomoprimeClassRegionPriceBase extends mfObject2 {
     
    protected static $fields=array('region_id','class_id','number_of_people','price','created_at','updated_at');
    const table="t_domoprime_class_region_price"; 
     protected static $foreignKeys=array('region_id'=>'DomoprimeRegion',
                                         'class_id'=>'DomoprimeClass',
                                         ); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
           if (isset($parameters['region']) && isset($parameters['revenue']) && isset($parameters['number_of_people']))
             return $this->loadbyRevenueAndNumberOfPersonAndRegion($parameters['region'],$parameters['revenue'],$parameters['number_of_people']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);         
      }   
    }
    
    protected function loadbyRevenueAndNumberOfPersonAndRegion($region,$revenue,$number_of_people)            
    {        
         $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('region_id'=>$region->get('id'),'number_of_people'=>$number_of_people,'revenue'=>$revenue))
                 ->setQuery("SELECT * FROM ".self::getTable().
                       " WHERE (region_id='{region_id}' OR region_id=0) AND number_of_people='{number_of_people}' AND price >='{revenue}'".
                       " ORDER BY region_id DESC,price ASC ".
                       " LIMIT 0,1".
                       ";")
            ->makeSiteSqlQuery($this->site);     
        //echo $db->getQuery();
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
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('number_of_people'=>$this->get('number_of_people'),
                               'class_id'=>$this->get('class_id'),
                               'region_id'=>$this->get('region_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName().
                    " FROM ".self::getTable().
                    " WHERE number_of_people='{number_of_people}' AND class_id='{class_id}' AND region_id='{region_id}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function hasRegion()
    {
        return (boolean)$this->get('region_id');
    }
    
      function getRegion()
    {
       if ($this->_region_id===null)
       {
          $this->_region_id=new DomoprimeRegion($this->get('region_id'),$this->getSite());          
       }   
       return $this->_region_id;
    }  
    
       function getClass()
    {
       if ($this->_class_id===null)
       {
          $this->_class_id=new DomoprimeClass($this->get('class_id'),$this->getSite());          
       }   
       return $this->_class_id;
    }  
    
   
}
