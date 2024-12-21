<?php

class DateFormatter extends Day {
    
    
    function getText($format="a")
    {
        return format_date($this->getDate(),$format);
    }
      
    
    function getAge($born_at,$date=null,$format_year="[0]0 year|[1]one year|(1,Inf]%s years",$format_month="",$format_day="")
    {
        return format_age($this->date,$born_at,$date,$format_year,$format_month,$format_day);
    }
    
    function getMonthAbbrAndYear()
    {
        return $this->getMonthAbbrNameI18n()." ".$this->getYear();
    }
    
    function getDateAndTime($format_date="a",$format_time="t",$separator="at")
    {
        return format_date($this->date,$format_date)." ".__($separator)." ".format_date($this->date,$format_time);
    }
    
    function getDateTime()
    {
        return new DayTime($this->date);
    }
}
