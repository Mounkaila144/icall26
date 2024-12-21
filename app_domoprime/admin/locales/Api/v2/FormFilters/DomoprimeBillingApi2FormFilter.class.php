<?php

require_once __DIR__."/../../../FormFilters/DomoprimeBillingFormFilter.class.php";

class DomoprimeBillingApi2FormFilter extends DomoprimeBillingFormFilter {

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

