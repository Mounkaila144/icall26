<?php


class DayRangeMeeting extends Day {
    
    protected $meetings=array(),$number_of_meeting=0;
    
    function addMeeting($meeting)
    {
        $this->meetings[]=$meeting;
        return $this;
    }
    
    function getMeetings()
    {
        return $this->meetings;
    }
    
    function count()
    {
        return count($this->meetings);
    }
    
    function getNumberOfMeetings()
    {
        if (!$this->number_of_meeting)
        {    
            $this->number_of_meeting=0;
            foreach ($this->schedule as $meeting_time)
            {
                if ($meeting_time->hasMeeting())
                {
                    $this->number_of_meeting+=$meeting_time->getNumberOfMeetings();
                }    
            }
        }
        return $this->number_of_meeting;
    }
    
    function buildSchedule()
    {      
        foreach (CustomerContractRange::getRangesI18n() as $range_i18n)
        {                                              
                $this->schedule[$range_i18n->get('range_id')]=new TimeRangeMeeting($range_i18n);            
        }          
    }
    
     function getScheduleRange($range_id)
    {
        return isset($this->schedule[$range_id])?$this->schedule[$range_id]:null;
    }
    
    function process()
    {
        $values=array();
        foreach ($this->schedule as $range_id=>$time_range)
        {
            $values[$range_id]=$time_range->getNumberOfMeetings();
        }                  
        $min=min($values);        
        $max=max($values);
        
        $this->schedule[array_search($max,$values)]->setIsHighest();
        $this->schedule[array_search($min,$values)]->setIsLowest();
        
       // echo "<pre>"; var_dump($values); echo "</pre>"; 
        return $this;
    }
}

