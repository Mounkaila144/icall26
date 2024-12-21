<?php


class TimeZoneFormatter extends mfString {
    
    function __construct(TimeZone $timezone) {
       $this->value =$timezone;
       $this->time=new Time();
    }
         
    function getText() {               
       return __("GMT {sign}{value}",array('sign'=>$this->getValue()->isPositif()?"+":"-",'value'=>$this->getValue()->getRaw() / 3600));
    }
    
    function __toString() {
        return (string)$this->getText();
    }
    
    function getTime()
    {
        return date("H:i:s",time() + $this->getValue()->getRaw());
    }
}

