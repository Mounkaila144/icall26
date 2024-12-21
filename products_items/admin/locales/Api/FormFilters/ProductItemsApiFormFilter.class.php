<?php

require_once __DIR__."/../../FormFilters/ProductItemFormFilter.class.php";

class ProductItemsApiFormFilter extends ProductItemFormFilter {
    
     function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
}
