<?php

require_once __DIR__.'/../../Forms/CustomerContractNewForm.class.php';

class ContractApiNewForm extends CustomerContractNewForm {
    
    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
    
    function getMapping()
    {         
         return $this->getValidatorSchema()->getMapping();       
    }
}
