<?php


class Timestamp extends mfInteger {
    
    
    function toDate($format="Y-m-d H:i:s")
    {
        return date($format,$this->getValue());
    }
    
    
    function toTime($format="H:i:s")
    {
        return date($format,$this->getValue());
    }
    
    function getHour()
    {
        return date("H",$this->getValue());
    }
    
    function getMinute()
    {
        return date("i",$this->getValue());
    }
    
    function getSecond()
    {
        return date("s",$this->getValue());
    }
        
    
    
}
