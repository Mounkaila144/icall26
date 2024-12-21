<?php

class MutualPartnerParamsBase extends mfObject2 {
    
    protected static $fields=array('financial_partner_id','taxe','fees','started_at','ended_at','created_at','updated_at');
    const table="t_app_mutual_partner_params"; 
    protected static $foreignKeys=array('financial_partner_id'=>'MutualPartner',
                                        ); 
    protected static $fieldsNull=array('started_at','ended_at','created_at','updated_at'); // By default
    
    function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);   
        $this->getDefaults(); 
        if ($parameters === null)  return $this;      
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {          
            if (isset($parameters['id']))
               return $this->loadbyId((string)$parameters['id']); 
            if (isset($parameters['financial_partner_id']))
               return $this->loadbyFinancialPartnerId((string)$parameters['financial_partner_id']); 
            return $this->add($parameters); 
        }   
        else
        {
            if ($parameters instanceof MutualPartner)
                return $this->loadbyPartner($parameters);
            if (is_numeric((string)$parameters)) 
               return $this->loadbyId((string)$parameters);
        }   
    }
    
    protected function executeLoadById($db)
    {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);  
    }
    
    protected function loadbyPartner($partner)
    {
        $this->set("financial_partner_id",$partner);
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array("financial_partner_id"=>$partner->get('id')))
           ->setQuery("SELECT * FROM ".self::getTable()." WHERE financial_partner_id='{financial_partner_id}';")
           ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
    protected function loadbyFinancialPartnerId($financial_partner_id)
    {
        $this->set("financial_partner_id",$financial_partner_id);
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array("financial_partner_id"=>$financial_partner_id))
           ->setQuery("SELECT * FROM ".self::getTable()." WHERE financial_partner_id='{financial_partner_id}';")
           ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
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
//        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
//        $db->setParameters(array('financial_partner_id'=>$this->get('financial_partner_id'),$this->getKey()))
//           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE financial_partner_id='{financial_partner_id}' ".$key_condition)
//           ->makeSiteSqlQuery($this->site);      
    }
       
    function getTaxePercent()
    {
        return format_pourcentage($this->get('taxe'));
    }
    
    function getFeesI18n()
    {
        return format_currency($this->get('fees'),'EUR');
    }
    
    function getStartedAt()
    {
        return format_date($this->get('started_at'),"a");
    }
    
    function getEndedAt()
    {
        return format_date($this->get('ended_at'),"a");
    }
    
    function hasMutualPartner()
    {
        return (boolean)$this->get('financial_partner_id');
    }
    
    public function getMutualPartner()
    {      
        if (!$this->_financial_partner_id)
        {
            $this->_financial_partner_id = new MutualPartner($this->get('financial_partner_id'));          
        }    
        return $this->_financial_partner_id;
    }
    
    public function setMutualPartner($financial_partner)
    {      
        $this->_financial_partner_id = $financial_partner;
        return $this;
    }
    
    function __toString() 
    {
        $this->get('taxe');
    }
    
    function getFormatter()
    {
        if($this->formatter==null)
            $this->formatter = new MutualPartnerParamsFormatter($this);
        return $this->formatter;
    }
    
    static function initializeSite($site=null)
    {
        mfSiteDatabase::getInstance()                      
                ->setQuery("TRUNCATE ".self::getTable().";")               
                ->makeSiteSqlQuery($site);                                       
    }  
}
