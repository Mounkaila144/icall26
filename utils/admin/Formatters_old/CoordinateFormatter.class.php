<?php

class CoordinateFormatter extends mfString {
    
           
    function __construct($item=null) {
        //parent::__construct($str);
        $this->value = $item;
    }
            
    function getFormatted(){
        return new mfString(format_dec_to_dms($this->value->get('lat'),$this->value->get('lng')));
    }
}
