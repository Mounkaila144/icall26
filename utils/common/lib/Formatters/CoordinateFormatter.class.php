<?php

class CoordinateFormatter extends mfFormatter {
    
           
    function __construct(GPSCoordinate $item) {
        //parent::__construct($str);
        $this->value = $item;
    }
            
    function getFormatted(){
        return new mfString(format_dec_to_dms($this->value->getLatitude(),$this->value->getLongitude()));
    }
    
    function __toString() {
        return (string)$this->getFormatted();
    }
}
