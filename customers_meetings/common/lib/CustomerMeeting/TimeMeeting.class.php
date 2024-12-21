<?php


class TimeMeeting extends Time {
    
    protected $meetings=null;
    
    function __construct($hour, $minute = 0, $second = null) {
        $this->meetings=new mfArray();
        parent::__construct($hour, $minute, $second);       
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
    
  /*  function count()
    {
        return count($this->meetings);
    }*/
    
    function hasMeeting($id)
    {
      return isset($this->meetings[$id]);     
    }
    
    function hasMeetings()
    {
        return !empty($this->meetings);
    }
    
    function getNumberOfMeetings()
    {        
        return count($this->meetings);
    }
    
    function getNumberOfConfirmedMeetings()
    {        
        $confirmed_meetings=0;
        foreach ($this->meetings as $meeting)
        {
            if ($meeting->get('is_confirmed')=='YES')
              $confirmed_meetings++;
        }    
        return $confirmed_meetings;
    }
    
    function getMeetingById($id,$default=null)
    {
        return isset($this->meetings[$id])?$this->meetings[$id]:$default;
    }
}

