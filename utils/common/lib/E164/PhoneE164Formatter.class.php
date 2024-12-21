<?php


class PhoneE164Formatter extends mfString {
    
    protected $value=null;
    
    function __construct($phone,$region="FR") {
        if (!$phone)
            return ;        
        $this->value=PhoneNumberUtil::getInstance()->parse($phone, $region);       
    }
    
        
    function getFormatted()
    {
        return $this->value;
    }        
    
    function getNumber()
    {                
        return mfString::getInstance('')->pad($this->value->getNumberOfLeadingZeros(),"0").$this->value->getNationalNumber();
    }
    
    function __toString()
    {
        return (string)$this->value;
    }
}

