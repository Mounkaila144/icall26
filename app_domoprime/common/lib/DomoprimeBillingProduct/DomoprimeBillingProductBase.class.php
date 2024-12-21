<?php


class DomoprimeBillingProductBase extends mfObject2 {
     
    protected static $fields=array('billing_id','title','entitled','product_id','contract_id','purchase_price_with_tax',
                                   'sale_price_with_tax','purchase_price_without_tax','sale_price_without_tax',
                                   'total_purchase_price_with_tax','total_sale_price_with_tax','total_purchase_price_without_tax',
                                   'total_sale_price_without_tax','quantity','description','tva_id','details','status', 
                                   'prime',
                                   'sale_discount_price_with_tax',
                                   'sale_discount_price_without_tax',
                                   'total_sale_discount_price_with_tax',
                                   'total_sale_discount_price_without_tax',
        
                                   'restincharge_price_with_tax',
                                   'restincharge_price_without_tax',        
                                   'total_restincharge_price_with_tax',
                                   'total_restincharge_price_without_tax',
        
                                   'added_price_with_tax',
                                   'added_price_without_tax',        
                                   'total_added_price_with_tax',
                                   'total_added_price_without_tax',
        
                                   'created_at','updated_at');
    const table="t_domoprime_billing_product"; 
     protected static $foreignKeys=array(
                                         'contract_id'=>'CustomerContract',    
                                         'product_id'=>'Product',    
                                         'tax_id'=>'Tax',
                                         'billing_id'=>'DomoprimeBilling'
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
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function getQuantity()
    {
        return floatval($this->get('quantity'));
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
    

    function addItem($item)
    {
        if ($this->product_items===null)      
            $this->product_items=new DomoprimeBillingProductItemCollection(null,$this->getSite());
        if (isset($this->product_items[$item->get('id')]))
           return $this;
        $this->product_items[$item->get('id')]=$item;                                 
        return $this;
    }
    
     function getProduct()
    {
        if ($this->_product_id===null)
        {
           $this->_product_id=new Product($this->get('product_id'),$this->getSite()) ;
        }    
        return $this->_product_id;
    }
    
    
    function getItems()
    {
        if ($this->product_items===null)
        {
            
        }    
        return $this->product_items;
    }
    
    
    function toArrayForBilling()
    {
        $values=parent::toArray(array('title'));
        foreach (array('quantity'=>'Quantity',                      
                       'total_sale_price_with_tax'=>'FormattedTotalSalePriceWithTax',
                       'total_sale_price_without_tax'=>'FormattedTotalSalePriceWithoutTax',     
                       'sale_price_with_tax'=>'FormattedSalePriceWithTax',
                       'sale_price_without_tax'=>'FormattedSalePriceWithoutTax',     
            
                       'restincharge_price_with_tax'=>'FormattedRestinchargePriceWithTax',
                       'restincharge_price_without_tax'=>'FormattedRestinchargePriceWithoutTax',        
                       'total_restincharge_price_with_tax'=>'FormattedTotalRestinchargePriceWithTax',
                       'total_restincharge_price_without_tax'=>'FormattedTotalRestinchargePriceWithoutTax',
        
                       'added_price_with_tax'=>'FormattedAddedPriceWithTax',
                       'added_price_without_tax'=>'FormattedAddedPriceWithoutTax',        
                       'total_added_price_with_tax'=>'FormattedTotalAddedPriceWithTax',
                       'total_added_price_without_tax'=>'FormattedTotalAddedPriceWithoutTax',
            
                       'total_price_adder_with_tax'=>'FormattedTotalPriceAndAdderWithTax',
                       'price_adder_with_tax'=>'FormattedPriceAndAdderWithTax'
                       
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }     
        $values['items']=$this->getItems()->toArrayForBilling();          
        $values['product']=$this->getProduct()->toArray(array('id','meta_title','reference','prime_price','unit'));       
        return $values;
    }
    
    
    function createFromQuotationProduct(DomoprimeQuotationProduct $product_quotation)
    {
        foreach (array('title','entitled','product_id','meeting_id','purchase_price_with_tax',
                       'sale_price_with_tax','purchase_price_without_tax','sale_price_without_tax',
                       'total_purchase_price_with_tax','total_sale_price_with_tax','total_purchase_price_without_tax',                       
                       'total_sale_price_without_tax','quantity','description','tva_id','details',
                       'sale_discount_price_with_tax','sale_discount_price_without_tax',
                       'total_sale_discount_price_with_tax','total_sale_discount_price_without_tax',
                       'restincharge_price_with_tax','restincharge_price_without_tax',        
                       'total_restincharge_price_with_tax','total_restincharge_price_without_tax',
                       'added_price_with_tax','added_price_without_tax',        
                       'total_added_price_with_tax','total_added_price_without_tax',
                    ) as $field)
        {
            $this->set($field,$product_quotation->get($field));
        }        
        return $this;
    }
    
    
    
    
    
    function getSaleDiscountPriceWithoutTax()
    {
        return floatval($this->get('sale_discount_price_without_tax'));
    }
    
    function getSaleDiscountPriceWithTax()
    {
        return floatval($this->get('sale_discount_price_with_tax'));
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
        
    function getAddedPriceWithTax()
    {
        return floatval($this->get('added_price_with_tax'));
    }
    
      function getFormattedAddedPriceWithTax()
    {
        return format_currency($this->getAddedPriceWithTax(),'EUR');
    }
    
    function getAddedPriceWithoutTax()
    {
        return floatval($this->get('added_price_without_tax'));
    }
    
      function getFormattedAddedPriceWithoutTax()
    {
        return format_currency($this->getAddedPriceWithoutTax(),'EUR');
    }
    
     function getTotalAddedPriceWithTax()
    {
        return floatval($this->get('total_added_price_with_tax'));
    }
    
      function getFormattedTotalAddedPriceWithTax()
    {
        return format_currency($this->getTotalAddedPriceWithTax(),'EUR');
    }
    
    function getTotalAddedPriceWithoutTax()
    {
        return floatval($this->get('total_added_price_without_tax'));
    }
    
      function getFormattedTotalAddedPriceWithoutTax()
    {
        return format_currency($this->getTotalAddedPriceWithoutTax(),'EUR');
    }
    
    
     function getRestinchargePriceWithTax()
    {
        return floatval($this->get('restincharge_price_with_tax'));
    }
    
      function getFormattedRestinchargePriceWithTax()
    {
        return format_currency($this->getRestinchargePriceWithTax(),'EUR');
    }
    
    function getRestinchargePriceWithoutTax()
    {
        return floatval($this->get('restincharge_price_without_tax'));
    }
    
      function getFormattedRestinchargePriceWithoutTax()
    {
        return format_currency($this->getRestinchargePriceWithoutTax(),'EUR');
    }
    
     function getTotalRestinchargePriceWithTax()
    {
        return floatval($this->get('total_restincharge_price_with_tax'));
    }
    
      function getFormattedTotalRestinchargePriceWithTax()
    {
        return format_currency($this->getTotalRestinchargePriceWithTax(),'EUR');
    }
    
    function getTotalRestinchargePriceWithoutTax()
    {
        return floatval($this->get('total_restincharge_price_without_tax'));
    }
    
      function getFormattedTotalRestinchargePriceWithoutTax()
    {
        return format_currency($this->getTotalRestinchargePriceWithoutTax(),'EUR');
    }
    
    
    
    function getTotalPriceAndAdderWithTax()
    {
        return  $this->getTotalAddedPriceWithTax() + $this->getTotalSalePriceWithTax();
    }
    
      function getFormattedTotalPriceAndAdderWithTax()
    {
        return format_currency($this->getTotalPriceAndAdderWithTax(),'EUR');
    }
    
    
    function getPriceAndAdderWithTax()
    {
        return  $this->getAddedPriceWithTax() + $this->getSalePriceWithTax();
    }
    
      function getFormattedPriceAndAdderWithTax()
    {
        return format_currency($this->getPriceAndAdderWithTax(),'EUR');
    }
    
  /*  function getTotalPrimePriceWithTax()
    {
        return floatval($this->get('prime'));
    }
    
    function getFormattedTotalPrimePriceWithTax()
    {
        return format_currency($this->getTotalPrimePriceWithTax(),'EUR');
    } 
    
    function getTotalPrimePriceWithoutTax()
    {
        return floatval($this->get('prime'));
    }
    
    function getFormattedTotalPrimePriceWithoutTax()
    {
        return format_currency($this->getTotalPrimePriceWithoutTax(),'EUR');
    } */ 
    
    function toArrayForApi2()
     {
         $values=$this->toValues()->toArray();
         $values['product']=$this->getProduct()->toArray();
         return $values;
     }
     
     function toArrayForHook()
     {
         $values=new mfArray($this->toValues()->toArray());
         $values['product']=$this->getProduct()->toArray();
         $values['items']=new mfArray();
         foreach ($this->getItems() as $item)
         {
            $values['items']->push($item->toArrayForHook());
         }
         return $values;
     }
}
