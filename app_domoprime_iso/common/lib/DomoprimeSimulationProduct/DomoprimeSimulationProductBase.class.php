<?php


class DomoprimeSimulationProductBase extends mfObject2 {
     
    protected static $fields=array('simulation_id','title','entitled','product_id','meeting_id','purchase_price_with_tax',
                                   'sale_price_with_tax','purchase_price_without_tax','sale_price_without_tax',
                                   'total_purchase_price_with_tax','total_sale_price_with_tax','total_purchase_price_without_tax',
                                   'total_sale_price_without_tax','quantity','description','tva_id','details','status',
                                   'prime',
                                   'created_at','updated_at');
    const table="t_domoprime_iso_simulation_product"; 
     protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting',    
                                         'product_id'=>'Product',    
                                         'tax_id'=>'Tax',
                                         'simulation_id'=>'DomoprimeSimulation'
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
    
     function getFormattedQuantity()
    {
        return format_number($this->get('quantity'),'#.00');
    }
    

    function addItem($item)
    {
        if ($this->product_items===null)      
            $this->product_items=new DomoprimeSimulationProductItemCollection(null,$this->getSite());
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
    
    
    function toArrayForSimulation()
    {
        $values=parent::toArray(array('title'));
        foreach (array('quantity'=>'Quantity',                      
                       'total_sale_price_with_tax'=>'FormattedTotalSalePriceWithTax',
                       'total_sale_price_without_tax'=>'FormattedTotalSalePriceWithoutTax',     
                       'sale_price_with_tax'=>'FormattedSalePriceWithTax',
                       'sale_price_without_tax'=>'FormattedSalePriceWithoutTax',
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }     
        $values['items']=$this->getItems()->toArrayForSimulation();
        return $values;
    }
    
}
