<?php


class DurationTime extends mfInteger {
  
    protected $start=null,$end=null;
    
    function __construct($start,$end) {               
        $this->end=($end instanceof DayTime || $end instanceof DayTime2)?$end->getTimestamp():$end;
        $this->start=($start instanceof DayTime || $start instanceof DayTime2)?$start->getTimestamp():$start;
    }       
    
    function getStart()
    {
        return $this->start;
    }
    
     function getEnd()
    {
        return $this->end;
    }
    
    
    function getDuration()
    {
        return  new mfInteger($this->getEnd()->getValue() - $this->getStart()->getValue());
    }
}
