<?php


class CustomerAddressFormatter extends mfFormatter {
   
    
    function getOutput($tpl=""){
 
        $field= str_replace('customer.address.','',$tpl[0]);
        return $this->getValue()->get($field);

    }
}
