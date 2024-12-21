<?php


class DomoprimeQuotationProductItemCollection extends mfObjectCollection3 {
    
    
    
    function toArrayForQuotation()
    {       
        $values=array();
        foreach ($this->collection as $item)
        {
            $values[]=$item->toArrayForQuotation();
        }           
        return $values; 
    }
    
    function toArrayForQuotation3()
    {       
        $values=array();
        foreach ($this->collection as $item)
        {
            $values[]=$item->toArrayForQuotation3();
        }           
        return $values; 
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
    
     function getTotalTax()
    {
        if ($this->total_tax===null)
        {
            $this->total_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_tax+=$item->getTotalTax();
        }    
        return $this->total_tax;
    }
    
    function getFormattedTotalSaleWithTax()
    {
        return format_currency($this->getTotalSaleWithTax(),'EUR');
    }
    
    function getFormattedTotalSaleWithoutTax()
    {
        return format_currency($this->getTotalSaleWithoutTax(),'EUR');
    }
    
    
    function getTotalSaleDiscountWithoutTax()
    {
        if ($this->total_sale_discount_without_tax===null)
        {
            $this->total_sale_discount_without_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_discount_without_tax+=$item->getTotalSaleDiscountPriceWithoutTax();
        }    
        return $this->total_sale_discount_without_tax;
    }
    
     function getTotalSaleDiscountWithTax()
    {
        if ($this->total_sale_discount_with_tax===null)
        {
            $this->total_sale_discount_with_tax=0.0;
            foreach ($this->collection as $item)
               $this->total_sale_discount_with_tax+=$item->getTotalSaleDiscountPriceWithTax();
        }    
        return $this->total_sale_discount_with_tax;
    }
       
        
    function asorttotalsalefct($a,$b)
    {
        if ($a->getTotalSalePriceWithTax()==$b->getTotalSalePriceWithTax())
            return 0;
        return ($a->getTotalSalePriceWithTax() > $b->getTotalSalePriceWithTax()) ? -1 : 1;
    }
    
    
    function sortByTotalSalePriceWithTax()
    {
        uasort($this->collection,array($this,'asorttotalsalefct'));         
        return $this;
    }
    
    function byItems()
    {
        if ($this->by_items===null)
         {
            $this->by_items=new DomoprimeQuotationProductItemCollection(null,$this->getSite());
            foreach ($this->collection as $item)
               $this->by_items[$item->get('item_id')]=$item;
        }    
        return $this->by_items;
    }
    
    function getTaxes()
    {
        if ($this->taxes===null)
        {    
            $this->taxes=new DomoprimeProductItemTaxes();
            foreach ($this->collection as $item)            
                $this->taxes->addTax($item->getTax());                 
            foreach ($this->collection as $item)  
            {    
               if ($item->get('unit_tax')) 
                   $this->taxes->getItemByKey($item->getTax()->get('id'))->add($item->getTotalTax());                          
               else
                   $this->taxes->getItemByKey($item->getTax()->get('id'))->add($item->getTotalSalePriceWithoutTax() * $item->getTax()->getRate());                          
            }
        }    
        return $this->taxes;       
    }
    
    function getMasters()
    {
        if ($this->masters===null)
        {
             $this->masters = new $this();
             $db=mfSiteDatabase::getInstance()
                ->setParameters(array()) 
                ->setObjects(array('DomoprimeQuotationProductItem','ProductItem')) 
                ->setQuery("SELECT {fields}  FROM ".DomoprimeQuotationProductItem::getTable().  
                           " INNER JOIN ".DomoprimeQuotationProductItem::getOuterForJoin('item_id').
                           " INNER JOIN ".ProductItemsItem::getInnerForJoin('item_master_id').
                           " WHERE ".DomoprimeQuotationProductItem::getTableField('id')." IN('".$this->getKeys()->implode("','")."')".      
                                    " AND ".ProductItem::getTableField('status')."='ACTIVE'".                         
                           ";")
                ->makeSiteSqlQuery($this->getSite());   
             if (!$db->getNumRows())
                  return $this->masters;        
              while ($items=$db->fetchObjects())
              {                        
                   $item=$items->getDomoprimeQuotationProductItem();
                   $item->set('item_id',$items->getProductItem());
                   $this->masters[$item->get('id')]=$item;       
              }           
              $this->masters->loaded();
        }
        return $this->masters;
    }    
}

