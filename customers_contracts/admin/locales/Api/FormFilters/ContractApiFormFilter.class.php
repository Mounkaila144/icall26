<?php

require_once __DIR__."/../../../lib/FormFilters/CustomerContractsFormFilter.class.php";

class ContractApiFormFilter extends CustomerContractsFormFilter {
    
     function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
    
    function getMapping()
    {
        return  $this->getValidatorSchema()->getMapping();
    }
}
