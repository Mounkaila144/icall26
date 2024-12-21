<?php


class DayTime {
  
    protected $day=null,$time=null;
    
    function __construct($datetime=null,$options=array()) {              
       $this->day=new Day($datetime);
       $this->time=new Time(date("H", strtotime($datetime)),date("i",strtotime($datetime)),date("s",strtotime($datetime)));
    }       
    
    function getDay()
    {
        return $this->day;
    }
    
    function getTime()
    {
        return $this->time;
    }
    
    function getDateTime()
    {
        return $this->getDay()->getDate()." ".$this->getTime()->getTime();
    }
    
    function __toString() {
        return (string)$this->getDateTime();
    }
  
    function getTimestamp()
    {
        return new Timestamp(strtotime($this->getDateTime()));
    }
}
