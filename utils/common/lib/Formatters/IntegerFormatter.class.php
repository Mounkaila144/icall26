<?php

class IntegerFormatter extends mfInteger {
    
    
    function getText($format="#")
    {
        return format_number($this->getValue(),$format);
    }
   
}
