<?php


class mfPhoneIndicatif {
    protected $code="",$country="";
    
    function __construct($code,$country) {
        $this->code=$code;
        $this->country=new mfString($country);
    }
    
    function getCountry()
    {
        return $this->country;
    }
    
    function getCode()
    {
        return $this->code;
    }
}
