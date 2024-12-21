<?php




class DomoprimeSimulationProductItemBase extends mfObject2 {
     
    protected static $fields=array( 'simulation_id','simulation_product_id','title','entitled' ,
                                        'item_id','purchase_price_with_tax',
        'sale_price_with_tax','purchase_price_without_tax','sale_price_without_tax',
        'total_purchase_price_with_tax','total_sale_price_with_tax','total_purchase_price_without_tax',
        'total_sale_price_without_tax','quantity', 'description','tva_id', 'details',  
        'is_mandatory','coefficient','unit','total_tax',
        'status', 'created_at', 'updated_at');
    const table="t_domoprime_iso_simulation_product_item"; 
       protected static $foreignKeys=array('simulation_id'=>'DomoprimeSimulation',    
                                         'simulation_product_id'=>'DomoprimeSimulationProduct', 
                                         'item_id'=>'ProductItem', 
                                         'tax_id'=>'Tax',                                        
                                        );    
     //  protected static $fieldsNull=array('coefficient'); // By default
       
       
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
         return $this->loadByEmail((string)$parameters);
      }   
    }
    
  /*  protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
        $this->is_mandatory=isset($this->is_mandatory)?$this->is_mandatory:"NO";
        $this->coefficient=isset($this->coefficient)?$this->coefficient:1.0;
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
      
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
    
    
    function getProductItem()
    {
        if ($this->_item_id===null)
        {
            $this->_item_id=new ProductItem($this->get('item_id'),$this->getSite());
        }   
        return $this->_item_id;
    }
    
    function toArrayForSimulation()
    {        
        $values=parent::toArray(array('title'));
        foreach (array('quantity'=>'FormattedQuantity',   
                       'unit'=>'FormattedUnitI18n',
                       'total_sale_price_with_tax'=>'FormattedTotalSalePriceWithTax',
                       'total_sale_price_without_tax'=>'FormattedTotalSalePriceWithoutTax',     
                       'sale_price_with_tax'=>'FormattedSalePriceWithTax',
                       'sale_price_without_tax'=>'FormattedSalePriceWithoutTax',
                       'total_tax'=>'FormattedTotalTax',
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }  
        $values['item']=$this->getProductItem()->toArrayForDocument();
        return $values;
    }
       
   
    
    function getQuantity()
    {
        return floatval($this->get('quantity'));
    }
    
     function getCoefficient()
    {
        return floatval($this->get('coefficient'));
    }
    
    function getFormattedQuantity()
    {
        return format_number($this->get('quantity'),'#.00');
    }
   
    function getPurchasePriceWithTax()
    {
        return floatval($this->get('purchase_price_with_tax'));
    }
    
    function getPurchasePriceWithoutTax()
    {
        return floatval($this->get('purchase_price_without_tax'));
    }
    
    function getSalePriceWithoutTax()
    {
        return floatval($this->get('sale_price_without_tax'));
    }
    
    function getSalePriceWithTax()
    {
        return floatval($this->get('sale_price_with_tax'));
    }
    
    function getTotalPurchasePriceWithTax()
    {
        return floatval($this->get('total_purchase_price_with_tax'));
    }
    
    function getTotalPurchasePriceWithoutTax()
    {
        return floatval($this->get('total_purchase_price_without_tax'));
    }
    
     function getTotalSalePriceWithoutTax()
    {
        return floatval($this->get('total_sale_price_without_tax'));
    }
    
      function getTotalTax()
    {
        return floatval($this->get('total_tax'));
    }
    
    function getTotalSalePriceWithTax()
    {
        return floatval($this->get('total_sale_price_with_tax'));
    }
    
     function getFormattedSalePriceWithoutTax()
    {
        return format_currency($this->getSalePriceWithoutTax(),'EUR');
    }
    
    function getFormattedSalePriceWithTax()
    {
        return format_currency($this->getSalePriceWithTax(),'EUR');
    }
    
     function getFormattedTotalSalePriceWithoutTax()
    {
        return format_currency($this->getTotalSalePriceWithoutTax(),'EUR');
    }
    
    function getFormattedTotalSalePriceWithTax()
    {
        return format_currency($this->getTotalSalePriceWithTax(),'EUR');
    }
    
     function getFormattedTotalTax()
    {
        return format_currency($this->getTotalTax(),'EUR');
    }
    
    function isMandatory()
    {
        return $this->get('is_mandatory')=='YES';
    }
    
     function getUnitI18n()
    {
        return __($this->get('unit'),array(),'messages','app_domoprime');
    }
    
      function getUnitAbbrI18n()
    {
        return __($this->get('unit'),array(),'abbr','app_domoprime');
    }
    
    
    function getFormattedUnitI18n()
    {
        return new StringAbbrFormatter(array('value'=>$this->getUnitI18n(),'abbr'=>$this->getUnitAbbrI18n()));
    }
}
