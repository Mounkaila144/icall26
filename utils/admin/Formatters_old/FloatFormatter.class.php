<?php

class FloatFormatter extends mfFloat {
    
    
    function getText($format="#")
    {
        return format_number($this->getValue(),$format);
    }
    
    function getAmount($format="#")
    {
        return format_currency($this->getValue(),'EUR',$format);
    }      
    
    function getPercent()
    {
        return format_pourcentage($this->getValue());
    }
}
