<?php

class MutualEngineCalculationMutualBase extends mfObject2 {
    
    protected static $fields=array('meeting_calculation_id','financial_partner_id','commission','decommission','date_calculation','is_active','status','created_at','updated_at');
    const table="t_app_mutual_engine_calculation_mutual"; 
    protected static $foreignKeys=array('meeting_calculation_id'=>'MutualEngineCalculationMeeting',
                                        'financial_partner_id'=>'MutualPartnerForEngine',
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
        if ($parameters instanceof MutualPartnerForEngine )
        {   
            $this->createFromMutualForEngine($parameters); 
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
    
    function hasMutualPartner()
    {
        return (boolean)$this->get('financial_partner_id');
    }
    
    public function getMeetingCalculation()
    {      
        if (!$this->_meeting_calculation_id)
        {
            $this->_meeting_calculation_id = new MutualEngineCalculationMeeting($this->get('meeting_calculation_id'), $this->getSite());          
        }    
        return $this->_meeting_calculation_id;
    }
     
    public function setMeetingCalculation($meeting_calculation)
    {      
        $this->_meeting_calculation_id = $meeting_calculation;    
        return $this;
    }
    
    public function getMutualPartnerForEngine()
    {      
        if (!$this->_financial_partner_id)
        {
            $this->_financial_partner_id = new MutualPartnerForEngine($this->get('financial_partner_id'),$this->getSite());          
        }    
        return $this->_financial_partner_id;
    }
    
    public function setMutualPartnerForEngine($mutual)
    {      
        $this->_financial_partner_id = $mutual;    
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
    
    function createFromMutualForEngine(MutualPartnerForEngine $mutual_engine)
    {
        $this->setMutualPartnerForEngine($mutual_engine);
        $this->set('financial_partner_id',$mutual_engine);
        $this->set('commission',$mutual_engine->getEngine()->getTotalCommission());
        $this->set('decommission',$mutual_engine->getEngine()->getTotalDecommission());
        $this->set('date_calculation',$mutual_engine->getEngine()->getEngineCore()->getCalculationDate()->format("Y-m-d H:i:s"));
        return $this;
    }
        
    function addProductCalculation(MutualEngineCalculationProduct $product_calculation)
    {
        if(!isset($this->product_calculations))
            $this->product_calculations = new MutualEngineCalculationProductCollection(null,$this->getSite());
        $this->product_calculations[$product_calculation->get('id')] = $product_calculation;
        return $this;
    }
    
    function getProductCalculations()
    {
        return $this->product_calculations;
    }
    
    function getFormatter()
    {
        if($this->formatter===null)
            $this->formatter = new MutualEngineCalculationMutualFormatter($this);
        return $this->formatter;
    }
}
