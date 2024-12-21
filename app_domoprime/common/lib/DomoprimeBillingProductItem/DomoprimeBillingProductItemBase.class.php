<?php




class DomoprimeBillingProductItemBase extends mfObject2 {
     
    protected static $fields=array( 'billing_id','billing_product_id','title','entitled' ,
                                        'item_id','purchase_price_with_tax',
        'sale_price_with_tax','purchase_price_without_tax','sale_price_without_tax',
        'total_purchase_price_with_tax','total_sale_price_with_tax','total_purchase_price_without_tax',
        'total_sale_price_without_tax','quantity', 'description','tva_id', 'details',   
        'total_tax','is_mandatory','unit','coefficient','is_master',
                  'sale_discount_price_with_tax',
                                   'sale_discount_price_without_tax',
                                   'total_sale_discount_price_with_tax',
                                   'total_sale_discount_price_without_tax','unit_tax',
        'status', 'created_at', 'updated_at');
    const table="t_domoprime_billing_product_item"; 
       protected static $foreignKeys=array('billing_id'=>'DomoprimeBilling',    
                                         'billing_product_id'=>'DomoprimeBillingProduct', 
                                         'item_id'=>'ProductItem', 
                                         'tax_id'=>'Tax',                                        
                                        );     
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
      $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
      $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");   
      $this->status=isset($this->status)?$this->status:"ACTIVE";
      $this->is_master=isset($this->is_master)?$this->is_master:"NO";
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
    
    
    function getProductItem()
    {
        if ($this->_item_id===null)
        {
            $this->_item_id=new ProductItem($this->get('item_id'),$this->getSite());
        }   
        return $this->_item_id;
    }
    
   
    function getTax()
    {
        return $this->_tva_id=$this->_tva_id===null?new Tax($this->get('tva_id'),$this->getSite()):$this->_tva_id;
    }
   
       
    function toArrayForBilling()
    {        
        $values=parent::toArray(array('title'));
        foreach (array('quantity'=>'FormattedQuantity',                      
                       'total_sale_price_with_tax'=>'FormattedTotalSalePriceWithTax',
                       'total_sale_price_without_tax'=>'FormattedTotalSalePriceWithoutTax',     
                       'sale_price_with_tax'=>'FormattedSalePriceWithTax',
                       'sale_price_without_tax'=>'FormattedSalePriceWithoutTax',
                       'total_tax'=>'FormattedTotalTax',
                       'unit'=>'FormattedUnitI18n',
            
                       'prime'=>'FormattedSurfacePrime',
                       'total_sale_discount_price_with_tax'=>'FormattedTotalSaleDiscountPriceWithTax',
                       'total_sale_discount_price_without_tax'=>'FormattedTotalSaleDiscountPriceWithoutTax',     
                       'sale_discount_price_with_tax'=>'FormattedSaleDiscountPriceWithTax',
                       'sale_discount_price_without_tax'=>'FormattedSaleDiscountPriceWithoutTax',
                       'total_gross_sale_price_without_tax'=>'FormattedTotalGrossSalePriceWithoutTax',
                       'total_gross_sale_price_with_tax'=>'FormattedTotalGrossSalePriceWithTax',
                       'rate_tax'=>'FormattedTaxRate',
                       'sale_discount_price_with_tax'=>'FormattedSaleDiscountPriceWithTax',
                       'sale_discount_price_without_tax'=>'FormattedSaleDiscountPriceWithoutTax',
                       'sale_gross_price_without_tax'=>'FormattedSaleGrossPriceWithoutTax',            
                       'unit_tax'=>'FormattedUnitTax',
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }  
        $values['is_master']=$this->get('is_master')=='YES';
        $values['item']=$this->getProductItem()->toArrayForDocument();
        $values['item']['description']=$this->getProductItem()->getFormattedDescription();       
        return $values;
    }
    
    function createFromQuotationItem(DomoprimeQuotationItem $product_item_quotation)
    {
       // echo "<pre>"; var_dump($product_item_quotation); echo "<pre>"; 
        foreach (array('title','entitled' ,'item_id','purchase_price_with_tax','product_item_id','product_id',
        'sale_price_with_tax','purchase_price_without_tax','sale_price_without_tax',
        'total_purchase_price_with_tax','total_sale_price_with_tax','total_purchase_price_without_tax',
        'unit','is_mandatory','coefficient','total_tax','is_master',
        'total_sale_price_without_tax','quantity', 'description','tva_id', 'details',
         'sale_discount_price_with_tax','sale_discount_price_without_tax',
         'total_sale_discount_price_with_tax','total_sale_discount_price_without_tax','unit_tax'
            ) as $field)
        {           
            $this->set($field,$product_item_quotation->get($field));
        }       
        
        return $this;
    }
   
    
     function getQuantity()
    {
        return floatval($this->get('quantity'));
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
    
     function getTotalTax()
    {
        return floatval($this->get('total_tax'));
    }
    
      function getFormattedTotalTax()
    {
        return format_currency($this->getTotalTax(),'EUR');
    }
    
      function getCoefficient()
    {
        return floatval($this->get('coefficient'));
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
    
    
    
     function getTotalSaleDiscountPriceWithoutTax()
    {
        return floatval($this->get('total_sale_discount_price_without_tax'));
    }
       
    function getTotalSaleDiscountPriceWithTax()
    {
        return floatval($this->get('total_sale_discount_price_with_tax'));
    }
    
     function getFormattedSaleDiscountPriceWithoutTax()
    {
        return format_currency($this->getSaleDiscountPriceWithoutTax(),'EUR');
    }
    
    function getFormattedSaleDiscountPriceWithTax()
    {
        return format_currency($this->getSaleDiscountPriceWithTax(),'EUR');
    }
    
     function getFormattedTotalSaleDiscountPriceWithoutTax()
    {
        return format_currency($this->getTotalSaleDiscountPriceWithoutTax(),'EUR');
    }
    
    function getFormattedTotalSaleDiscountPriceWithTax()
    {
        return format_currency($this->getTotalSaleDiscountPriceWithTax(),'EUR');
    }
    
    function getTotalGrossSalePriceWithTax()
    {
       return   $this->getTotalSalePriceWithTax() - $this->getTotalSaleDiscountPriceWithTax();
    }
    
    function getFormattedTotalGrossSalePriceWithTax()
    {
       return format_currency($this->getTotalGrossSalePriceWithTax(),'EUR');
    }
    
    function getTotalGrossSalePriceWithoutTax()
    {
       return   $this->getTotalSalePriceWithoutTax() - $this->getTotalSaleDiscountPriceWithoutTax();
    }
    
    function getFormattedTotalGrossSalePriceWithoutTax()
    {
       return format_currency($this->getTotalGrossSalePriceWithoutTax(),'EUR');
    }
    
    
    function getFormattedTaxRate()
    {
        return format_pourcentage($this->getTax()->getRate());
    }
   
    function getFormattedSaleGrossPriceWithoutTax()
    {
         return format_currency($this->getSalePriceWithoutTax() - $this->getSaleDiscountPriceWithoutTax(),'EUR');
    }
    
    function getFormattedSurfacePrime()
    {
        return format_number($this->getSurfacePrime(),"#.00");
    }
    
    function getSurfacePrime()
    {
        return $this->get('quantity') * $this->getProductItem()->getProduct()->get('prime_price');
    }
    
    function getSaleDiscountPriceWithTax()
    {
        return floatval($this->get('sale_discount_price_with_tax'));
    }
    
      function getSaleDiscountPriceWithoutTax()
    {
        return floatval($this->get('sale_discount_price_without_tax'));
    }
    
    function getUnitTax()
    {
        return floatval($this->get('unit_tax'));
    } 
    
     function getFormattedUnitTax()
    {
        return format_currency($this->getUnitTax(),'EUR'); 
    }
    
    
    function toArrayForHook()
    {
        $values=parent::toValues();      
        $values['item']=$this->getProductItem()->toValues();
        return $values;
    }
}
