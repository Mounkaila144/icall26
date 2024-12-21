<?php
 

class ProductSettings extends ProductSettingsBase {
        
      protected $products=null;
      
     function getDefaults()
     {   
         $this->add(array(
                /* PRICING */                
                "default_currency"=>"EUR",
                "has_purchasing_price"=>"NO",
                "default_products"=>array(),  // Meeting
                "default_contract_products"=>array()
              ));        
     }
     
     function hasDefaultProducts()
     {
        return $this->getDefaultProducts()->count();
     }
     
     function getDefaultProductsById()
     {
         $products=array();
         foreach ($this->get('default_products') as $product_id)
        {
            if ($product_id=="")
                continue;
            $products[]=$product_id;
        }
         return $products;
     }
     
          
     
     function getDefaultProducts()
     {
         if ($this->products===null)
         {    
            $this->products=new mfArray();
            foreach ((array)$this->get('default_products') as $product_id)
            {
                if ($product_id=="")
                    continue;
                $this->products[]=array('product_id'=>$product_id,'details'=>'');
            }
         }      
         return $this->products;
     }
     
     /* ========================= CONTRACT =================================== */
     
     function hasDefaultContractProducts()
     {
        return $this->getDefaultContractProducts()->count();
     }
     
     function getDefaultContractProductsById()
     {
         $products=array();
         foreach ($this->get('default_contract_products') as $product_id)
        {
            if ($product_id=="")
                continue;
            $products[]=$product_id;
        }
         return $products;
     }
     
               
     function getDefaultContractProducts()
     {
         if ($this->contract_products===null)
         {    
            $this->contract_products=new mfArray();
            foreach ((array)$this->get('default_contract_products') as $product_id)
            {
                if ($product_id=="")
                    continue;
                $this->contract_products[]=array('product_id'=>$product_id,'details'=>'');
            }
         }      
         return $this->contract_products;
     }
     
     
}
