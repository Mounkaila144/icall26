<?php


class CustomerContractProductItemCollection extends mfObjectCollection3 {
         
    
    function getItemsForDefaults($products,$defaults)
    {           
        foreach ($this->collection as $item)
        {
            if (isset($products[$item->get('product_id')]))
               $defaults[$products[$item->get('product_id')]]=$item->get('item_id');
        }    
        return $defaults;
    }
    
    
    function getProductsWithItem()
    {
        if ($this->products===null)
        {
            $this->products=new ProductCollection(null,$this->getSite());
            foreach ($this as $item)
            {
                $this->products[$item->getProduct()->get('id')]=$item->getProduct()->set('item',$item);                                
            }                
        }    
        return $this->products;
    }
    
    
}

