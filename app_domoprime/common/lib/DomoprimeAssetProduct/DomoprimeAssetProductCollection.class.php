<?php

/*
 *  NOT IMPLEMENTED
 */


class DomoprimeAssetProductCollection extends mfObjectCollection2 {
    
    
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
    
    
   /* function getTotalSaleWithoutTax()
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
        $values=array();
        foreach ($this->collection as $item)
        {
            $values[]=$item->toArrayForBilling();
        }    
      /*  $values['total_purchase_with_tax']=$this->getTotalPurchaseWithTax();
        $values['total_purchase_without_tax']=$this->getTotalPurchaseWithoutTax();
        $values['total_sale_with_tax']=$this->getFormattedTotalSaleWithTax();
        $values['total_sale_without_tax']=$this->getFormattedTotalSaleWithoutTax();*/
      /*  return $values;
    }*/
            
   
    
}

