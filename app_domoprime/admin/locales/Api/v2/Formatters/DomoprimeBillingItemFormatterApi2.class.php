<?php

class DomoprimeBillingItemFormatterApi2   extends mfFormatterFilterItemApi2  {        
   
    
    function process()
    {
      $this->data =$this->getItem()->toValues()->toArray();    
      $this->data['products']=array();
      foreach ($this->getItem()->getProducts() as $billing_product)
          $this->data['products'][]=$billing_product->toArrayForApi2();      
      return $this;
    }
  
}
