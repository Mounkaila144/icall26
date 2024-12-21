<?php


class DomoprimeBillingProductCollection extends mfObjectCollection2 {
    
    
     function __construct($data=null,$site=null) {
         parent::__construct($data,null, $site);
     }
     
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site); 
    }
    
    
    function getTotalSaleWithoutTax()
    {
        if ($this->total_sale_without_tax===null)
        {
            $this->total_sale_without_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_without_tax+=$item->getTotalSalePriceWithoutTax();
        }    
        return $this->total_sale_without_tax;
    }
    
     function getTotalSaleWithTax()
    {
        if ($this->total_sale_with_tax===null)
        {
            $this->total_sale_with_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_with_tax+=$item->getTotalSalePriceWithTax();
        }    
        return $this->total_sale_with_tax;
    }
    
    
    function getTotalPurchaseWithoutTax()
    {
        if ($this->total_purchase_without_tax===null)
        {
            $this->total_purchase_without_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_purchase_without_tax+=$item->getTotalPurchasePriceWithoutTax();
        }    
        return $this->total_purchase_without_tax;
    }
    
     function getTotalPurchaseWithTax()
    {
        if ($this->total_purchase_with_tax===null)
        {
            $this->total_purchase_with_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_purchase_with_tax+=$item->getTotalPurchasePriceWithTax();
        }    
        return $this->total_purchase_with_tax;
    }
    
    function getFormattedTotalSaleWithTax()
    {
        return format_currency($this->getTotalSaleWithTax(),'EUR');
    }
    
    function getFormattedTotalSaleWithoutTax()
    {
        return format_currency($this->getTotalSaleWithoutTax(),'EUR');
    }
       
    
    function toArrayForBilling()
    {
        $product_surface=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();
        $values=array();
        foreach ($this->collection as $item)
        {
             if ($product_surface[$item->get('product_id')])
                $values[$product_surface[$item->get('product_id')]]=$item->toArrayForBilling();
             else
                $values[]=$item->toArrayForBilling();
        }    
      /*  $values['total_purchase_with_tax']=$this->getTotalPurchaseWithTax();
        $values['total_purchase_without_tax']=$this->getTotalPurchaseWithoutTax();
        $values['total_sale_with_tax']=$this->getFormattedTotalSaleWithTax();
        $values['total_sale_without_tax']=$this->getFormattedTotalSaleWithoutTax();*/
        return $values;
    }
            
   
    
    function hasMaster()
    {
        return $this->getMaster();
    }
    
    function getMaster()
    {      
        if ($this->master===null)
        {    
            foreach ($this->collection as $product)
            {    
                foreach ($product->getItems() as  $item)
                {    
                    if ($item->get('is_master')=='YES')
                    {
                        $this->master= $item;
                        return $this->master;
                    }
                }            
            }
            $this->master=false;
        }        
        return $this->master;                 
    }    
   
    
      function toArrayForQuotationApi2()
    {             
         $product_surface=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();
        $values=array();
        foreach ($this->collection as $item)
        {
             if ($product_surface[$item->get('product_id')])
                $values[$product_surface[$item->get('product_id')]]=$item->toArrayForApi2();
             else
                $values[]=$item->toArrayForApi2();
        }                     
        return $values;
    }
    
    function toArrayForHook()
    {
       // $product_surface=DomoprimeSettings::load($this->getSite())->getTypeNamesForProducts();
        $values=new mfArray();
        foreach ($this->collection as $item)
        {
             $values[]=$item->toArrayForHook();
        }                     
        return $values;
    }
}

