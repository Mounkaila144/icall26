<?php


class DayMeeting extends Day {
    
    protected $meetings=null,$number_of_meeting=0,$number_of_confirmed_meetings=0;
    
    function __construct($date = null, $options = array()) {
        $this->meetings=new mfArray();
        parent::__construct($date, $options);                
    }
    
    function addMeeting($meeting)
    {
        $this->meetings[$meeting->get('id')]=$meeting;
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
                if ($meeting_time->hasMeetings())
                {
                    $this->number_of_meeting+=$meeting_time->getNumberOfMeetings();
                }    
            }
        }
        return $this->number_of_meeting;
    }
    
    function getNumberOfConfirmedMeetings()
    {
        if (!$this->number_of_confirmed_meetings)
        {    
            $this->number_of_confirmed_meetings=0;
            foreach ($this->schedule as $meeting_time)
            {
                if ($meeting_time->hasMeetings())
                {
                    $this->number_of_confirmed_meetings+=$meeting_time->getNumberOfConfirmedMeetings();
                }    
            }
        }
        return $this->number_of_confirmed_meetings;
    }
}

