<?php

class MutualProductBase extends mfObject2 {
    
    protected static $fields=array('financial_partner_id','name','price','is_active','status','created_at','updated_at');
    const table="t_app_mutual_product"; 
    protected static $foreignKeys=array('financial_partner_id'=>'MutualPartner',
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
        $this->is_active=isset($this->is_active)?$this->is_active:'NO';
        $this->status=isset($this->status)?$this->status:'ACTIVE';
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
        $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
           ->makeSiteSqlQuery($this->site);      
    }
       
    function hasMutualPartner()
    {
        return (boolean)$this->get('financial_partner_id');
    }
    
    public function setMutualPartner($financial_partner)
    {      
        $this->_financial_partner_id = $financial_partner;
        return $this;
    }
    
    public function getMutualPartner()
    {      
        if (!$this->_financial_partner_id)
        {
            $this->_financial_partner_id = new MutualPartner($this->get('financial_partner_id'));          
        }    
        return $this->_financial_partner_id;
    }
    
    
    function __toString() 
    {
        return ucfirst($this->get("name"));
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
    
    public static function getProducts($site=null)
    {      
        $values = new mfArray();
        $db=mfSiteDatabase::getInstance()
                        ->setParameters(array())                       
                        ->setQuery("SELECT ".MutualProduct::getFieldsAndKeyWithTable()." FROM ".MutualProduct::getTable().                                   
                                   " WHERE ".MutualProduct::getTableField('status')."='ACTIVE'".
                                   ";")
                        ->makeSiteSqlQuery($site);  
        
        if(!$db->getNumRows())
            return $values;
        
        while($item = $db->fetchObject('MutualProduct'))
        {
            $values[$item->get('id')] = $item;
        }
        
        return $values;
    }
    
    public static function getUnselectedProductsForMeeting(MutualPartner $mutual,CustomerMeeting $meeting,$site=null)
    {      
        /*
         *  SELECT * FROM t_mutual_product 
            INNER JOIN t_partners_company ON t_partners_company.id=t_mutual_product.financial_partner_id 
            LEFT JOIN t_customers_meeting_mutual_products ON t_customers_meeting_mutual_products.product_id=t_mutual_product.id 
                AND t_customers_meeting_mutual_products.meeting_id='79104' 
            WHERE t_mutual_product.status='ACTIVE' AND t_mutual_product.financial_partner_id='2' AND t_customers_meeting_mutual_products.meeting_id IS NULL
            ORDER BY t_mutual_product.name ASC
         */
        $values = new mfArray();
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('financial_partner_id'=>$mutual->get('id'),'meeting_id'=>$meeting->get('id')))                       
            ->setQuery("SELECT ".MutualProduct::getFieldsAndKeyWithTable()." FROM ".MutualProduct::getTable().                                   
                       " LEFT JOIN ".CustomerMeetingMutualProduct::getInnerForJoin("product_id").
                       " AND ".CustomerMeetingMutualProduct::getTableField("meeting_id")."='{meeting_id}'".
                       " WHERE ".MutualProduct::getTableField('status')."='ACTIVE'".
                       " AND ".MutualProduct::getTableField('financial_partner_id')."='{financial_partner_id}'".
                       " AND ".CustomerMeetingMutualProduct::getTableField('id')." IS NULL".
                       " ORDER BY ".MutualProduct::getTableField('name')." ASC ".
                       ";")
            ->makeSiteSqlQuery($site);  
//        echo $db->getQuery();
        if(!$db->getNumRows())
            return $values;
        
        while($item = $db->fetchObject('MutualProduct'))
        {
            $values[$item->get('id')] = $item;
        }
        
        return $values;
    }
    
    public static function getProductsForMutual(MutualPartner $mutual,$site=null)
    {      
        $values = new mfArray();
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('financial_partner_id'=>$mutual->get('id')))                       
            ->setQuery("SELECT ". MutualProduct::getFieldsAndKeyWithTable()." FROM ".MutualProduct::getTable().                                   
                       " WHERE ".MutualProduct::getTableField('status')."='ACTIVE'".
                       " AND ".MutualProduct::getTableField('financial_partner_id')."='{financial_partner_id}'".
                       ";")
            ->makeSiteSqlQuery($site);  
        
        if(!$db->getNumRows())
            return $values;
        
        while($item = $db->fetchObject('MutualProduct'))
        {
            $values[$item->get('id')] = $item;
        }
        
        return $values;
    }
    
    function getPriceI18n()
    {
        return format_currency($this->get('price'),'EUR');
    }
    
    static function initializeSite($site=null)
    {
        $db = mfSiteDatabase::getInstance() ;
//        //meeting_products
//        $db ->setQuery("TRUNCATE ". CustomerMeetingMutualProduct::getTable().";")               
//            ->makeSiteSqlQuery($site);
//        //commissions && decommissions
//        $db ->setQuery("TRUNCATE ". MutualProductCommission::getTable().";")               
//            ->makeSiteSqlQuery($site);                                       
//        $db ->setQuery("TRUNCATE ". MutualProductDecommission::getTable().";")               
//            ->makeSiteSqlQuery($site);  
//        //engine calculation
//        $db ->setQuery("TRUNCATE ". MutualEngineCalculationProduct::getTable().";")               
//            ->makeSiteSqlQuery($site); 
//        $db ->setQuery("TRUNCATE ". MutualEngineCalculationMutual::getTable().";")               
//            ->makeSiteSqlQuery($site); 
        $db ->setQuery("TRUNCATE ". MutualEngineCalculationMeeting::getTable().";")               
            ->makeSiteSqlQuery($site); 
        
        //this table (products)
        $db->setQuery("TRUNCATE ".self::getTable().";")               
            ->makeSiteSqlQuery($site);                                       
                                  
    }  
}
