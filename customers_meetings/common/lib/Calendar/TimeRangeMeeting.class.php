<?php


class TimeRangeMeeting  {
    
    protected $meetings=array(),$range_i18n=null,$is_lowest=false,$is_highest=false;
    
    function __construct($range_i18n)    
    {
        $this->range_i18n=$range_i18n;
    }
    
    function addMeeting($meeting)
    {
        $this->meetings[]=$meeting;
        return $this;
    }
    
    function getMeetings()
    {
        return $this->meetings;
    }
    
  /*  function count()
    {
        return count($this->meetings);
    }*/
    
    function hasMeeting()
    {
        return !empty($this->meetings);
    }
    
    function getNumberOfMeetings()
    {        
        return count($this->meetings);
    }
    
    function getRangeI18n()
    {
        return $this->range_i18n;
    }    
    
    function setIsLowest()
    {
        $this->is_lowest=true;
        return $this;
    }
    
    function setIsHighest()
    {
        $this->is_highest=true;
        return $this;
    }
    
    function isLowest()
    {
        return $this->is_lowest;
    }
    
    function isHighest()
    {
        return $this->is_highest;
    }
    
    function getColor()
    {
        if ($this->isLowest() || !$this->hasMeeting())
            return "#00ff00";
        if ($this->isHighest())
            return "#ff0000";     
    }
}

