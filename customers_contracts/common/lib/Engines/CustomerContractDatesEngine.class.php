<?php


class CustomerContractDatesEngine extends mfObjectBase {
     
    
    
    function getNumberOfContractNotValid()
    {
        return $this->number_of_contract_not_valid;
    }
     
    
    function process()
    {
        
      //  $number_of_contract_not_valid= CustomerContractUtils::getNumberOfDatesNotValid();
        
        CustomerContractUtils::updateDatesIsValid();
        
        $this->number_of_contract_not_valid=CustomerContractUtils::getNumberOfDatesNotValid();
        return $this;
    }
    
    
    
    
}
