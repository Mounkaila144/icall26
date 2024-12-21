<?php

class SystemSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array( 
                           "time_shift"=>0,
                           "holidays"=>array(),
                           "open_days"=>array()
                          ));
        
     }        
     
     
     static function getGmtRange()
     {
         $values=new mfArray();
         for ($i=-11;$i < 12; $i++)       
             $values[$i]=__('GMT %d',$i);         
         return $values;
     }
     
     function getTimeShift()
     {
         return intval($this->get('time_shift'));
     }
     
     
     function getFormattedHolidays()
    {
        $holidays = new mfArray();
        foreach($this->get("holidays") as $holiday)
        {
            $holidays[] = format_date($holiday,"a");
        }
        return $holidays;
    }
    
    function getHolidays()
    {
        $holidays = new mfArray();
        foreach($this->get("holidays") as $holiday)
        {
            $holidays[] = $holiday;
        }
        return $holidays; 
    }
    
    function getOpenDays()
    {         
        if ($this->_open_days===null)
           $this->_open_days=new mfArray($this->get('open_days',array()));   
        return $this->_open_days;
    }
    
    function getNumberOfDayOnForWeek()
    {
        return 7 - count($this->get('open_days'));
    }
    
    function getNumberOfDaysOff()
    {
        $count=$this->getHolidays()->count();        
        if ($count > 0 && $count > $this->getNumberOfDayOnForWeek())
             return $count+1;
        return $this->getNumberOfDayOnForWeek()+1;
    }
   
    
   /* function getNearestOpenDay(Day $date_requested)
    {        
        $date = $date->getDaySub($this->get("days_to_sub"));
//        echo "<pre>"; var_dump($date->isWeekEnd()); echo "</pre>";
        while(!$this->inOpenDays($date->getDayNameAbr()) || $this->inHolidays($date->getDate()))
        {
            $date = $date->getPreviousDay();
        }
        return $date->getDate("d/m/Y");
    }*/
    
}
