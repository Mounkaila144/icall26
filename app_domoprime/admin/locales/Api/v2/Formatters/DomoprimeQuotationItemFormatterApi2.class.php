<?php

class DomoprimeQuotationItemFormatterApi2   extends mfFormatterFilterItemApi2  {        
   
    
    function process()
    {
      $this->data =$this->getItem()->toValues()->toArray();    
      $this->data['products']=array();
      foreach ($this->getItem()->getProductsWithItems() as $quotation_product)
          $this->data['products'][]=$quotation_product->toArrayForApi2();      
      return $this;
    }
  
}
