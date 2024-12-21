<?php

// hour:minutes:second

class Time {
    
    protected $hour=0,$minute=0,$second=0;
    
    function __construct($hour,$minute=0,$second=null) {     
        $this->hour=$hour;
        $this->minute=$minute;    
        $this->second=$second;
    }
    
    function getHour()
    {
        return $this->hour;
    }
    
    function getMinute()
    {
        return $this->minute;
    }
    
    function getSecond()
    {
        return $this->second;
    }
    
   
    
    function getTime($separator=":")
    {
        $time=sprintf("%02d",$this->hour).$separator.sprintf("%02d",$this->minute);
        if ($this->second===null)
            return $time;        
        return $time.$separator.sprintf("%02d",$this->second);
    }
    
    function render($tpl="{hour}:{minute}:{second}")
    {
        return strtr($tpl,array('{hour}'=>$this->getHour(),'{minute}'=>$this->getMinute(),'{second}'=>$this->getSecond()));     
    }
    
    function __toString() {
        return (string)$this->getTime();
    }
}

