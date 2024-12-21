<?php

class MutualProductDecommissionBase extends mfObject2 {
    
    protected static $fields=array('mutual_product_id','from','to','rate','fix','started_at','ended_at','is_active','status','created_at','updated_at');
    const table="t_app_mutual_decommission"; 
    protected static $foreignKeys=array('mutual_product_id'=>'MutualProduct',
                                        ); 
    protected static $fieldsNull=array('created_at','updated_at');
    
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
        }   
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
        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
        $db->setParameters(array('started_at'=>$this->get('started_at'),'ended_at'=>$this->get('ended_at'),'mutual_product_id'=> $this->get('mutual_product_id'),$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE started_at='{started_at}' AND ended_at='{ended_at}' AND mutual_product_id='{mutual_product_id}' ".$key_condition)
           ->makeSiteSqlQuery($this->site);           
    }
       
    function getRatePercent()
    {
        return format_pourcentage($this->get('rate'));
    }
    
    function getStartedAt()
    {
        return format_date($this->get('started_at'),"a");
    }
    
    function getEndedAt()
    {
        return format_date($this->get('ended_at'),"a");
    }
    
    function hasMutualProduct()
    {
        return (boolean)$this->get('mutual_product_id');
    }
    
    public function getMutualProduct()
    {      
        if (!$this->_mutual_product_id)
        {
            $this->_mutual_product_id = new MutualProduct($this->get('mutual_product_id'));          
        }    
        return $this->_mutual_product_id;
    }
    
    public function setMutualProduct($mutual_product)
    {      
        $this->_mutual_product_id = $mutual_product;    
        return $this;
    }
    
    function __toString() 
    {
        return $this->get("from")." => ".$this->get("to");
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
    
    function getFormatter()
    {
        if($this->formatter===null)
            $this->formatter = new MutualProductDecommissionFormatter($this);
        return $this->formatter;
    }
}
