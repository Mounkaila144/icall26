<?php


class CustomerContractCompanyFormatter extends mfFormatter {
    
    
    
    function getName()
    {
        return new mfString($this->getValue()->get('name'));
    }
    
}
