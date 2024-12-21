<?php


class CustomerMeetingCalandarRange extends Calendar {
   
    protected $ranges_i18n=null;
    
    function getRangesI18n()
    {
        if ($this->ranges_i18n===null)
        {
            $this->ranges_i18n=CustomerContractRange::getRangesI18n();         
        }
        return $this->ranges_i18n;
    }
    
    function getDayWithRange($day,$range_id)
  {              
     if (!$day=$this->getDay($day->getDate()))      
          return null;                  
     return $day->getScheduleRange($range_id);
  }
 
  function process()
  {
      foreach ($this->getDays() as $day)
      {
          $day->process();
      }    
      return $this;
  }
}
