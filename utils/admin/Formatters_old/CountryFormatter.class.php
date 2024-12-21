<?php

class CountryFormatter extends mfString {
    
    
    
    
     function  getFormatted($lang=null){
        
        return new mfString(format_country($this->value,$lang));
    }
    
    function __toString() {
        return (string)$this->getFormatted($lang=null);
    }
    
    function getCode()
    {
        return new mfString($this->getValue());
    }
}
