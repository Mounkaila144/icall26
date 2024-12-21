<?php

class MutualEngineCalculationMeetingBase extends mfObject2 {
    
    protected static $fields=array('meeting_id','commission','decommission','date_calculation','is_last','is_active','status','created_at','updated_at');
    const table="t_app_mutual_engine_calculation_meeting"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeetingMutual',
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
        if ($parameters instanceof AppMutualEngineCore)
        {  
            $this->processEngine($parameters);
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
        $this->is_last=isset($this->is_last)?$this->is_last:'NO';
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
    
    function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    public function getMeeting()
    {      
        if (!$this->_meeting_id)
        {
            $this->_meeting_id = new CustomerMeetingMutual($this->get('meeting_id'));          
        }    
        return $this->_meeting_id;
    }
    
    public function setMeeting($meeting)
    {      
        $this->_meeting_id = $meeting;    
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
    
    function processEngine(AppMutualEngineCore $engine)
    {
        $mutuals_calculation_engine = new MutualEngineCalculationMutualCollection(null, $this->getSite());
        $products_calculation_engine = new MutualEngineCalculationProductCollection(null,$this->getSite());
        
        $this->set('commission',$engine->getGlobalCommission());
        $this->set('decommission',$engine->getGlobalDecommission());
        $this->set('meeting_id', $engine->getMeeting());
        $this->save();
        
        foreach($engine->getProducts() as $mutual)
        {
            //pour chaque mutual creer une collection des produits calculation
            //parcourire tt les produits
            $mutual_calculation = new MutualEngineCalculationMutual($mutual);
            $mutual_calculation->set("meeting_calculation_id", $this);
            $mutuals_calculation_engine[] = $mutual_calculation;
        }
        
        $mutuals_calculation_engine->save();
        $this->mutual_calculations = $mutuals_calculation_engine;
        foreach($mutuals_calculation_engine as $mutual)
        {
            //pour chaque mutual creer une collection des produits calculation
            //parcourire tt les produits
            foreach($mutual->getMutualPartnerForEngine()->getSelectedgetProductsForEngine() as $product)
            {
                $product_calculation = new MutualEngineCalculationProduct($product);
                $product_calculation->set("meeting_calculation_id", $this);
                $product_calculation->set("mutual_calculation_id", $mutual);
                $products_calculation_engine[] = $product_calculation;
            }
        }
        
        $products_calculation_engine->save();
        $this->mutual_calculations->setProductsForMutualsCalculation($products_calculation_engine);
        return $this;
    }
    
    function addMutualCalculation(MutualEngineCalculationMutual $mutual_calculation)
    {
        if(!isset($this->mutual_calculations))
            $this->mutual_calculations = new MutualEngineCalculationMutualCollection (null, $this->getSite());
        $this->mutual_calculations[$mutual_calculation->get('id')] = $mutual_calculation;
        return $this;
    }
    
    function getMutualCalculations()
    {
        return $this->mutual_calculations;
    }
    
    static function getFirstEngineMeetingCalculationForMeeting(CustomerMeeting $meeting,$site=null)
    {
        $meeting_calculation = new MutualEngineCalculationMeeting(null,$site);
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('meeting_id'=>$meeting->get('id')))                       
            ->setObjects(array('MutualEngineCalculationMeeting','CustomerMeetingMutual','MutualEngineCalculationMutual',
                                'MutualProductForEngine','MutualEngineCalculationProduct','MutualPartnerForEngine','Customer'))                       
            ->setQuery("SELECT {fields} FROM ". MutualEngineCalculationProduct::getTable().  
                        " INNER JOIN ". MutualEngineCalculationProduct::getOuterForJoin("product_id").
                        " INNER JOIN ". MutualEngineCalculationProduct::getOuterForJoin("mutual_calculation_id").
                        " INNER JOIN ". MutualEngineCalculationMutual::getOuterForJoin("financial_partner_id").
                        " INNER JOIN ". MutualEngineCalculationMutual::getOuterForJoin("meeting_calculation_id").
                        " INNER JOIN ". MutualEngineCalculationMeeting::getOuterForJoin("meeting_id").
                        " INNER JOIN ". CustomerMeetingMutual::getOuterForJoin("customer_id").
                        " WHERE ".MutualEngineCalculationMeeting::getTableField("meeting_id")."='{meeting_id}'".
                        " AND ".MutualEngineCalculationMeeting::getTableField("is_last")."='YES'".
//                        " ORDER BY ".MutualEngineCalculationMeeting::getTableField("id")." DESC LIMIT 0,1".
                        ";")
            ->makeSiteSqlQuery($site);  
        
        if(!$db->getNumRows())
            return $meeting_calculation;
        
        while ($items = $db->fetchObjects()) 
        {
            if($meeting_calculation->isNotLoaded())
                $meeting_calculation=$items->getMutualEngineCalculationMeeting();  
            
            $meeting = $items->getCustomerMeetingMutual();
            $meeting->setCustomer($items->getCustomer());
            $meeting_calculation->setMeeting($meeting);
            
            $mutual = $items->getMutualEngineCalculationMutual();
            $mutual->setMutualPartnerForEngine($items->getMutualPartnerForEngine());
            if($meeting_calculation->getMutualCalculations())
            {
                if($meeting_calculation->getMutualCalculations()->getItemByKey($mutual->get('id'))!== null)
                    $mutual=$meeting_calculation->getMutualCalculations()->getItemByKey($mutual->get('id'));
            }
            
            $product = $items->getMutualEngineCalculationProduct();
            $product->setMutualProductForEngine($items->getMutualProductForEngine()); 
            
            $mutual->addProductCalculation($product);
            $meeting_calculation->addMutualCalculation($mutual);     
        }
        
        return $meeting_calculation;
    }
    
    function updateIsLast()
    {
        /*
         * UPDATE `t_app_mutual_engine_calculation_meeting` SET is_last=(CASE WHEN id<252 THEN 'NO' WHEN id=252 THEN 'YES' ELSE 'NO' END)
         * WHERE meeting_id='79108' AND id=(SELECT * FROM (SELECT MAX(id) FROM `t_app_mutual_engine_calculation_meeting` 
         * WHERE meeting_id='79108') tmp)
        */
        $db=mfSiteDatabase::getInstance()->setParameters(array('meeting_id'=> $this->get('meeting_id'),'id'=>$this->get('id')));
        $db->setQuery("UPDATE ".self::getTable()." SET is_last='NO' WHERE meeting_id='{meeting_id}' AND id<'{id}';")
           ->makeSiteSqlQuery($this->site);
        $db->setParameters(array('meeting_id'=> $this->get('meeting_id'),'id'=>$this->get('id')))
           ->setQuery("UPDATE ".self::getTable()." SET is_last='YES' WHERE meeting_id='{meeting_id}' AND id = (SELECT * FROM (SELECT MAX(id) FROM ".self::getTable().
                      " WHERE meeting_id='{meeting_id}') tmp);")
           ->makeSiteSqlQuery($this->site);
    }
    
    function save() {
        parent::save();
        $this->updateIsLast();
    }
    
    static function getMutualsAndProductsForPager(MutualMeetingCalculationPager $pager)
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array())                       
            ->setObjects(array('MutualEngineCalculationMeeting','MutualEngineCalculationMutual',
                                'MutualProductForEngine','MutualEngineCalculationProduct','MutualPartnerForEngine'))                       
            ->setQuery("SELECT {fields} FROM ". MutualEngineCalculationProduct::getTable().  
                        " INNER JOIN ". MutualEngineCalculationProduct::getOuterForJoin("product_id").
                        " INNER JOIN ". MutualEngineCalculationProduct::getOuterForJoin("mutual_calculation_id").
                        " INNER JOIN ". MutualEngineCalculationMutual::getOuterForJoin("financial_partner_id").
                        " INNER JOIN ". MutualEngineCalculationMutual::getOuterForJoin("meeting_calculation_id").
                        " WHERE ".MutualEngineCalculationMeeting::getTableField("id")." IN ('". implode("','",array_keys($pager->getItems()))."')".
                        ";")
            ->makeSiteSqlQuery($site);  
        
        if(!$db->getNumRows())
            return ;
        
        while ($items = $db->fetchObjects()) 
        {
            $mutual = $items->getMutualEngineCalculationMutual();
            $mutual->setMutualPartnerForEngine($items->getMutualPartnerForEngine());
            if($pager[$mutual->get('meeting_calculation_id')]->getMutualCalculations()!== null)
            {
                if($pager[$mutual->get('meeting_calculation_id')]->getMutualCalculations()->getItemByKey($mutual->get('id'))!== null)
                    $mutual=$pager[$mutual->get('meeting_calculation_id')]->getMutualCalculations()->getItemByKey($mutual->get('id'));
            }
            
            $product = $items->getMutualEngineCalculationProduct();
            $product->setMutualProductForEngine($items->getMutualProductForEngine()); 
            
            $mutual->addProductCalculation($product);
            $pager[$mutual->get('meeting_calculation_id')]->addMutualCalculation($mutual);    
        }
        
    }
    
    function getFormatter()
    {
        if($this->formatter===null)
            $this->formatter = new MutualEngineCalculationMeetingFormatter($this);
        return $this->formatter;
    }
}
