<?php
require_once __DIR__."/../../../FormFilters/CustomerMeetingsFormFilter.class.php";

class CustomerMeetingApi2FormFilter extends CustomerMeetingsFormFilter {

    function configure()
    {                 
        $this->setOption('disabledCSRF',true);           
        parent::configure();
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new CustomerMeetingSettings():$this->settings;
    }
    
     
}

