<?php

class DomoprimeProductBase extends ProductBase {
     
     function __construct($parameters = null, $site = null) {
         if ($parameters instanceof Product)
         {
             $this->setSite($parameters->getSite());
             foreach ($parameters as $field=>$data)
                 $this->set($field,$data);
             $this->isLoaded();
         }    
         parent::__construct($parameters, $site);
     }
     
     function process($coef,$class)
     {
         
     }
     
     
     function getTotalSalePriceWithTax()
     {
         return floatval($this->get('total_sale_price_with_tax'));
     }
}
