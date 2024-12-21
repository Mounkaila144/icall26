<?php

class UtilsHolidayCalendarSettings extends mfSettingsBase {
    
    protected static $instance=null;    

    function __construct($data=null,$site=null)
    {
        parent::__construct($data,null,'frontend',$site);
    } 

    function getDefaults()
    {   
        $this->add(array(
                    "holidays"=>"",
                    "open_days"=>"",
                    "days_to_sub"=>5,
                ));
    }    
    
    function getHolidays()
    {
        $holidays = new mfArray();
        foreach(explode(";", $this->get("holidays")) as $holiday)
        {
            $holidays[$holiday] = format_date($holiday,"a");
        }
        return $holidays;
    }
    
    function getHolidaysAsString()
    {
        return $this->getHolidays()->implode(";");
    }
    
    function inHolidays($day)
    {
        return in_array($day, array_keys($this->getHolidays()->toArray()));
    }
    
    function setHolidays($holidays)
    {
        if(empty($holidays))
            return;
        $this->set('holidays', $holidays);
    }
    
//    function getDayFromDate($date_string)
//    {
//        if(DateTime::createFromFormat("d/m/Y", $date_string))
//            return DateTime::createFromFormat("d/m/Y", $date_string)->format("D");
//    }
    
    function getOpenDays()
    {
        $open_days = new mfArray();
        foreach(explode(";", $this->get("open_days")) as $open_day)
        {
            $open_days[] = $open_day;
        }
        return $open_days;
    }
    
    function inOpenDays($day)
    {
        return in_array($day, $this->getOpenDays()->toArray());
    }
    
    function setOpenDays($open_days)
    {
        $this->set('open_days', implode(";", $open_days));
    }
    
    function calculateDate($date_str)
    {
        $date = new Day($date_str);
        $date = $date->getDaySub($this->get("days_to_sub"));
//        echo "<pre>"; var_dump($date->isWeekEnd()); echo "</pre>";
        while(!$this->inOpenDays($date->getDayNameAbr()) || $this->inHolidays($date->getDate()))
        {
            $date = $date->getPreviousDay();
        }
        return $date->getDate("d/m/Y");
    }
    
    
}
