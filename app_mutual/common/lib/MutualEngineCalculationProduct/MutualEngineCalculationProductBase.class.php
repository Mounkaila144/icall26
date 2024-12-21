<?php

class MutualEngineCalculationProductBase extends mfObject2 {
    
    protected static $fields=array('meeting_calculation_id','mutual_calculation_id','product_id','commission','decommission','date_calculation','is_active','status','created_at','updated_at');
    const table="t_app_mutual_engine_calculation_product"; 
    protected static $foreignKeys=array('meeting_calculation_id'=>'MutualEngineCalculationMeeting',
                                        'mutual_calculation_id'=>'MutualEngineCalculationMutual',
                                        'product_id'=>'MutualProduct',
                                        ); 
    protected static $fieldsNull=array('created_at','updated_at'); // By default
    
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
        if ($parameters instanceof CustomerMeetingMutualProductForEngine)
        {          
            $this->createFromProductForEngine($parameters);
            return $this;
        }   
        else
        {
            if (is_numeric((string)$parameters)) 
               return $this->loadbyId((string)$parameters);
        }   
    }
    
    protected function executeLoadById($db)
    {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
        $this->commission=isset($this->commission)?$this->commission:0.0;
        $this->decommission=isset($this->decommission)?$this->decommission:0.0;
        $this->date_calculation=isset($this->date_calculation)?$this->date_calculation:date("Y-m-d H:i:s");
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
        $this->is_active=isset($this->is_active)?$this->is_active:'NO';
        $this->status=isset($this->status)?$this->status:'ACTIVE';
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
//        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
//        $db->setParameters(array('started_at'=>$this->get('started_at'),'ended_at'=>$this->get('ended_at'),'mutual_product_id'=> $this->get('mutual_product_id'),$this->getKey()))
//           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE started_at='{started_at}' AND ended_at='{ended_at}' AND mutual_product_id='{mutual_product_id}' ".$key_condition)
//           ->makeSiteSqlQuery($this->site);           
    }
        
    function getDateCalculation()
    {
        return format_date($this->get('date_calculation'),"a");
    }
    
    function getCreatedAt()
    {
        return format_date($this->get('created_at'),"a");
    }
    
    function getUpdatedAt()
    {
        return format_date($this->get('updated_at'),"a");
    }
    
    function hasMeetingCalculation()
    {
        return (boolean)$this->get('meeting_calculation_id');
    }
    
    function hasMutualCalculation()
    {
        return (boolean)$this->get('mutual_calculation_id');
    }
    
    function hasMutualProduct()
    {
        return (boolean)$this->get('product_id');
    }
    
    public function getMeetingCalculation()
    {      
        if (!$this->_meeting_calculation_id)
        {
            $this->_meeting_calculation_id = new MutualEngineCalculationMeeting($this->get('meeting_calculation_id'));          
        }    
        return $this->_meeting_calculation_id;
    }
     
    public function setMeetingCalculation($meeting_calculation)
    {      
        $this->_meeting_calculation_id = $meeting_calculation;    
        return $this;
    }
    
    public function getMutualCalculation()
    {      
        if (!$this->_mutual_calculation_id)
        {
            $this->_mutual_calculation_id = new MutualEngineCalculationMutual($this->get('mutual_calculation_id'));          
        }    
        return $this->_mutual_calculation_id;
    }
     
    public function setMutualCalculation($mutual_calculation)
    {      
        $this->_mutual_calculation_id = $mutual_calculation;    
        return $this;
    }
    
    public function geMutualProductForEngine()
    {      
        if (!$this->_product_id)
        {
            $this->_product_id = new MutualProductForEngine($this->get('product_id'));          
        }    
        return $this->_product_id;
    }
    
    public function setMutualProductForEngine($product)
    {      
        $this->_product_id = $product;    
        return $this;
    }
    
    function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','NO');
        $this->save();
    }
    
    function enable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','YES');
        $this->save();
    }
    
    function getCommissionI18n()
    {
        return format_currency($this->get('commission'),'EUR');
    }
    
    function getDecommissionI18n()
    {
        return format_currency($this->get('decommission'),'EUR');
    }
    
    function createFromProductForEngine(CustomerMeetingMutualProductForEngine $mutual_product_engine)
    {
        $this->setMutualProductForEngine($mutual_product_engine->getProductForEngine());
        $this->set('product_id',$mutual_product_engine->get('product_id'));
        $this->set('commission',$mutual_product_engine->getEngine()->getTotalCommission());
        $this->set('decommission',$mutual_product_engine->getEngine()->getTotalDecommission());
        $this->set('date_calculation',$mutual_product_engine->getEngine()->getEngineCore()->getCalculationDate()->format("Y-m-d H:i:s"));
        return $this;
    }
    
    function getFormatter()
    {
        if($this->formatter===null)
            $this->formatter = new MutualEngineCalculationProductFormatter($this);
        return $this->formatter;
    }
    
    
}
