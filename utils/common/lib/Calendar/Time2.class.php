<?php

// hour:minutes:second

class Time2 {
    
    protected $hour=0,$minute=0,$second=0;
    
    function __construct($hour=null,$minute=0,$second=null) {    
        if ($hour===null)
        {    
            $hour=date("H",time());
            $minute=date("i",time());
            $second=date("s",time());
        }
        $this->hour=new mfInteger($hour);
        $this->minute=new mfInteger($minute);    
        $this->second=new mfInteger($second);
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
    
    function getHourMinute($separator=":")
    {
        return  sprintf("%02d",$this->hour->getValue()).$separator.sprintf("%02d",$this->minute->getValue());
    }        
    
    function getTime($separator=":")
    {
        $time=sprintf("%02d",$this->hour->getValue()).$separator.sprintf("%02d",$this->minute->getValue());
        if ($this->second===null)
            return $time;        
        return $time.$separator.sprintf("%02d",$this->second->getValue());
    }
    
    function getTimeWithSecond($separator=":")
    {
       return sprintf("%02d",$this->hour->getValue()).$separator.sprintf("%02d",$this->minute->getValue()).$separator.sprintf("%02d",$this->second->getValue()); 
    }
    
    function isAm()
    {
        if ($this->second->getValue()===null)                  
           return ($this->hour->getValue() == 12)?$this->minute->getValue() <= 59:$this->hour->getValue() >=0 && $this->hour->getValue() < 12;        
        return ($this->hour->getValue() == 12)?$this->minute->getValue() <= 59 && $this->second <= 59:$this->hour->getValue() >=0 && $this->hour->getValue() < 12;
    }
    
    function isPM()
    {
        return !$this->isAm();
    }
    
    function addHour($hour)
    {                  
          return $this->toTime($this->_getTimeStamp($this->getValue() + $hour * 3600));
    }
    
    function subHour($hour)
    {                  
          return $this->toTime($this->_getTimeStamp($this->getValue() - $hour * 3600));
    }
    
    function addMinute($minute)
    {                            
          return $this->toTime($this->_getTimeStamp($this->getValue() + $minute * 60));
    }
    
    function subMinute($minute)
    {                            
          return $this->toTime($this->_getTimeStamp($this->getValue() - $minute * 60));
    }
    
    function getHourMinuteToArray()
    {
        return array('hour'=>$this->getHour(),'minute'=>$this->getMinute());
    }
    
    function getValue()
    {
        return strtotime(date('Y-m-d')." ".$this->getTimeWithSecond());
    }
    
    function getTimeStamp()
    {
        return new Timestamp($this->getValue());
    }
    
    protected function _getTimeStamp($value)
    {
        return new Timestamp($value);
    }
    
    protected function toTime(Timestamp $time)
    {
        return new $this($time->getHour(),$time->getMinute(),$time->getSecond());
    }
}

