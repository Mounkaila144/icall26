<?php

class customers_contracts_ListFilterContractActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {                     
        $this->user=$this->getUser();                      
        $this->formFilter= new CustomerContractsFormFilter($this->getUser());                                         
        $this->settings_contracts=CustomerContractSettings::load();    
    } 
    
    
}