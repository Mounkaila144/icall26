<?php


class CustomerContractProductCollection extends mfObjectCollection3 {
    
    protected $actions=null;
    
     
    
    function hasActions()
    {
        $this->getActions();
        return !$this->actions->isEmpty();
    }
    
    function getActions()
    {
        if ($this->actions===null)
        {    
            $this->actions=new ProductActionCollection(null,$this->getSite());
            foreach ($this->collection as $contract_product)
            {
                if ($contract_product->getProduct()->hasAction())
                    $this->actions[$contract_product->getProduct()->getAction()->get('id')]=$contract_product->getProduct()->getAction();
            }
        }
        return $this->actions;
    }
    
   /* function getItemByKey($key,$default=null)
    {
        return isset($this->collection[$key])?$this->collection[$key]:$default;
    }
    
    function hasItemByKey($key)
    {
        return isset($this->collection[$key]);
    }*/
    
    function getProductsForDefaults($products,$defaults)
    {                  
        foreach ($products as $id=>$field)
        {
            if (isset($this->collection[$id]))
                 $defaults[$field]=$this->collection[$id]->get('added_price_with_tax');
            else
                 $defaults[$field]=0.0;          
        }        
        return $defaults;    
    }
}

