<?php


class ProductItemProductBase  extends Product{
    
   
      function addItemsExcepted(ProductItem $item){
        
        if(isset($this->excepted_items[$item->get('id')]))
            return $this;
        $this->excepted_items[$item->get('id')]=$item;
        return $this;
        
    }
    
    function getItemsExcepted(){
        
        if ($this->excepted_items===null)
        {
           $this->excepted_items=new ProductItemCollection(null,$this->getSite());
        }
        return $this->excepted_items;
        
    }
}
