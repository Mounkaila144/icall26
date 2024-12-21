<?php


class DayTime2 {
  
    protected $day=null,$time=null;
    
    function __construct($datetime=null,$options=array()) {              
       if ($datetime===null)
           $datetime=date("Y-m-d H:i:s");     
       $this->day=new Day2($datetime);                   
       $this->time=new Time2(date("H", strtotime($datetime)),date("i",strtotime($datetime)),date("s",strtotime($datetime)));
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
    
    function getDateHourMinute($format_date="Y-m-d",$separator=" ",$format_time=":")
    {
        return $this->getDay()->getDate($format_date).$separator.$this->getTime()->getHourMinute($format_time);
    }
    
    function getDateHourMinuteSecond($format_date="Y-m-d",$separator=" ",$format_time=":")
    {
        return $this->getDay()->getDate($format_date).$separator.$this->getTime()->getTimeWithSecond($format_time);
    }
    
    function __toString() {
        return (string)$this->getDateTime();
    }
  
    function addHour($add_hour)
    {
        $hour=$this->time->getHour()->getValue()+$add_hour;
        $day =$hour / 24;
        $this->time=new Time2(($hour % 24).":00" );
        if ($day != 0)
            $this->day=$this->day->getDayAdd(intval($day));
        return $this;
    }
    
    function subHour($hour)
    {
        $time=$this->time->getHour()->getValue()-$hour;       
        $day =$time / 24;
        $this->time=new Time2(($time % 24).":00",$this->time->getMinute()->getValue(),$this->time->getSecond()->getValue() );
        if ($day != 0)
            $this->day=$this->day->getDaySub(intval($day));
        return $this;
    }
    
     function addMinute($add_minute)
    {  
        $minute=$this->time->getMinute()->getValue() + $add_minute;
        $sub=0;
        if ($minute >= 60)
        {
            $this->addHour(1);
            $sub=60;
        }                    
        $this->time=new Time2($this->time->getHour()->getValue(),$minute-$sub,$this->time->getSecond()->getValue() );        
        return $this;
    }
    
    function subMinute($sub_minute)
    {
         $minute=$this->time->getMinute()->getValue() - $sub_minute;
         if ($minute < 0)
         {            
            $this->subHour(1);            
            $this->time=new Time2($this->time->getHour()->getValue(),60+$minute,$this->time->getSecond()->getValue() );      
            return $this;
         }
         $this->time=new Time2($this->time->getHour()->getValue(),$minute,$this->time->getSecond()->getValue() );      
         return $this;
    }
    
    function getTimestamp()
    {
        return new Timestamp($this->getValue());
    }
    
    function getValue()
    {
        return strtotime($this->getDateHourMinuteSecond());
    }
    
    function sub($duration)
    {
        return new $this(Date("Y-m-d H:i:s",$this->getTimestamp()->getValue() - $duration)); 
    }
    
    function mod($mod)
    {
        return new $this(Date("Y-m-d H:i:s",$this->getValue() - ($this->getValue() % $mod)));
    }
}
