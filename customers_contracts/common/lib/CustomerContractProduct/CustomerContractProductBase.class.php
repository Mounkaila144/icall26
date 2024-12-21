<?php


class CustomerContractProductBase extends mfObject2 {
     
    
    protected static $fields=array('contract_id','product_id','details',
                                   'quantity',
                                   'tva_id',
                                   //'is_billable',
                                   'is_consumed',
                                   'sale_price_with_tax',
                                   'purchase_price_with_tax',
                                   'sale_price_without_tax',
                                   'purchase_price_without_tax',
                                   'total_sale_price_with_tax',
                                   'total_purchase_price_with_tax',
                                   'total_sale_price_without_tax',
                                   'total_purchase_price_without_tax',   
                                   'is_one_shoot','started_at','ended_at','is_prorata',                                 
                                   'created_at','updated_at');
    const table="t_customers_contract_product"; 
    protected static $foreignKeys=array('contract_id'=>'CustomerContract',
                                        'tva_id'=>'Tax',
                                        'product_id'=>'Product'); // By default
    protected static $fieldsNull=array('started_at','ended_at'); // By default  
    
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;       
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {         
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['product_id']) && isset($parameters['contract_id']))
             return $this->loadbyProductIdAndContractId($parameters['product_id'],$parameters['contract_id']); 
           if (isset($parameters['product']) && isset($parameters['contract']))
             return $this->loadbyProductAndContract($parameters['product'],$parameters['contract']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         
      }   
    }
    
     protected function loadbyProductAndContract($product,$contract)
    {
         $this->set('product_id',$product);
         $this->set('contract_id',$contract);      
         $db=mfSiteDatabase::getInstance()->setParameters(array('product_id'=>$product->get('id'),'contract_id'=>$contract->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE product_id='{product_id}' AND contract_id='{contract_id}';")
            ->makeSiteSqlQuery($this->site);    
         return $this->rowtoObject($db);
    }
    
   protected function loadbyProductIdAndContractId($product_id,$contract_id)
    {
         $this->set('product_id',$product_id);
         $this->set('contract_id',$contract_id);      
         $db=mfSiteDatabase::getInstance()->setParameters(array('product_id'=>$product_id,'contract_id'=>$contract_id));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE product_id='{product_id}' AND contract_id='{contract_id}';")
            ->makeSiteSqlQuery($this->site);          
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
       $this->quantity=isset($this->quantity)?$this->quantity:0.0;  
       $this->is_consumed=isset($this->is_consumed)?$this->is_consumed:"NO";  
       $this->is_one_shoot=isset($this->is_one_shoot)?$this->is_one_shoot:"NO";
       $this->is_prorata=isset($this->is_prorata)?$this->is_prorata:"NO";
       $this->added_price_with_tax=isset($this->added_price_with_tax)?$this->added_price_with_tax:0.0;
       $this->added_price_without_tax=isset($this->added_price_without_tax)?$this->added_price_without_tax:0.0;
       $this->total_added_price_with_tax=isset($this->total_added_price_with_tax)?$this->total_added_price_with_tax:0.0;
       $this->total_added_price_without_tax=isset($this->total_added_price_without_tax)?$this->total_added_price_without_tax:0.0;
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
      $db->setParameters(array('product_id'=>$this->get('product_id'),'contract_id'=>$this->get('contract_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable().
                    " WHERE contract_id='{contract_id}' AND product_id='{product_id}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
   
    public function getProduct()
    {      
        if (!$this->_product_id)
        {
            $this->_product_id=new Product($this->get('product_id'),$this->getSite());          
        }    
        return $this->_product_id;
    }
    
    function getContract()
    {
        if (!$this->_contract_id)
        {
            $this->_contract_id=new CustomerContract($this->get('contract_id'),$this->getSite());
        }    
        return $this->_contract_id;
    }       
    
      function hasTax()
    {
       return (boolean)$this->tva_id; 
    }
    
      function getTax()
    {
       if ($this->_tva_id ===null)
       {
          $this->_tva_id=new Tax($this->get('tva_id'),$this->getSite());          
       }   
       return $this->_tva_id;
    }  

    function getFormattedQuantity()
    {
        return format_number($this->get('quantity'),"#.00");
    }
    
    function getFormattedSalePriceWithTax()
    {        
        return format_number($this->getSalePriceWithTax(),"#.00"); 
    }
    
    function getSalePriceWithTax()
    {        
        return $this->get('sale_price_without_tax') * ( 1 + $this->getTax()->get('rate')); 
    }
    
     function getFormattedSalePriceWithoutTax()
    {
        return format_number($this->getSalePriceWithoutTax());
    }
    
     function getSalePriceWithoutTax()
    {
        return $this->get('sale_price_without_tax');
    }
    
    function getFormattedPurchasePriceWithTax()
    {
        return format_number($this->getPurchasePriceWithTax(),"#.00");        
    }
    
    function getPurchasePriceWithTax()
    {
        return $this->get('purchase_price_without_tax') * ( 1 + $this->getTax()->get('rate'));        
    }
    
     function getFormattedPurchasePriceWithoutTax()
    {
        return format_number($this->getPurchasePriceWithoutTax());
    }
    
     function getPurchasePriceWithoutTax()
    {
        return $this->get('purchase_price_without_tax');
    }
    
    function getFormattedTotalPurchasePriceWithoutTax()
    {
        return format_number($this->get('total_purchase_price_without_tax'),"#.00");
    }
    
    function getTotalPurchasePriceWithoutTax()
    {
        return $this->get('purchase_price_without_tax') * $this->get('quantity');
    }
    
     function getFormattedTotalSalePriceWithoutTax()
    {
       return format_number($this->get('total_sale_price_without_tax'),"#.00"); 
    }
    
    function getTotalSalePriceWithoutTax()
    {
       return $this->get('sale_price_without_tax') * $this->get('quantity'); 
    }
    
    
    function getFormattedTotalPurchasePriceWithTax()
    {
        return format_number($this->get('total_purchase_price_with_tax'),"#.00");          
    }
    
    function getTotalPurchasePriceWithTax()
    {
        return $this->get('quantity') * $this->get('purchase_price_without_tax') * ( 1 + $this->getTax()->get('rate'));
    }
    
     function getFormattedTotalSalePriceWithTax()
    {
       return format_number($this->get('total_sale_price_with_tax'),"#.00");          
    }
    
    function getTotalSalePriceWithTax()
    {
        return $this->get('quantity') * $this->get('sale_price_without_tax') * ( 1 + $this->getTax()->get('rate'));
    }
    
    function calculate()
    {
        $this->add(array('sale_price_with_tax'=>$this->getSalePriceWithTax(),
                         'purchase_price_with_tax'=>$this->getPurchasePriceWithTax(),
                         
                         'total_sale_price_with_tax'=>$this->getTotalSalePriceWithTax(),
                         'total_purchase_price_with_tax'=>$this->getTotalPurchasePriceWithTax(),
                         'total_sale_price_without_tax'=>$this->getTotalSalePriceWithoutTax(),
                         'total_purchase_price_without_tax'=>$this->getTotalPurchasePriceWithoutTax()));
        return $this;
    }
    
    
    function isOneShoot()
    {
        return $this->get('is_one_shoot')=='YES';
    }
    
    function isProrata()
    {
        return $this->get('is_prorata')=='YES';
    }
    
    function hasStarted()
    {
        return (boolean)$this->get('started_at');
    }            
    
    function getQuantity()
    {
        return floatval($this->get('quantity'));
    }
}
