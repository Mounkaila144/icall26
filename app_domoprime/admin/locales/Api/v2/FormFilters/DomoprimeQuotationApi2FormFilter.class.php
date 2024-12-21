<?php

require_once __DIR__."/../../../FormFilters/DomoprimeQuotationFormFilter.class.php";

class DomoprimeQuotationApi2FormFilter extends DomoprimeQuotationFormFilter {

    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
        
        
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new DomoprimeSettings():$this->settings;
    }
    
    
    
     
}

