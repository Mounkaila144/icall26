<?php

class DateTimeFormatter extends DayTime2 {
    
    
    
    function getDateFormatter()
    {
        return new DateFormatter($this->getDay());
    }
        
    function getText($format="d")
    {
        return format_date($this->getDay(),$format)." ".$this->getTime()->getHourMinute();
    }    
    
    function getFormatted($format=array('d','q'))
    {
        return format_date((string)$this,$format);       
    }
    
    function getAge($born_at,$date=null,$format_year="[0]0 year|[1]one year|(1,Inf]%s years",$format_month="",$format_day="")
    {
        return format_age($this->date,$born_at,$date,$format_year,$format_month,$format_day);
    }
    
    
     function getDateTimeFormats()
    {        
        $values=new mfArray();
        foreach (array("ddmmyyyyhhii"=>array("d","q")) as $name=>$format)
        {           
            $values[$name]=format_date((string)$this->getDateTime(),$format);    
        }    
        return $values;
    }  
    
    function getDateAndTimeFormats()
    {        
        $values=new mfArray();
        foreach (array("ddmmyyyy"=>"a","ddmmyy"=>'d',"ddmmmmyyyy"=>"D","yyyymmdd"=>'yyyyMMdd',"ddmmyyyyhhii"=>array("d","q")) as $name=>$format)
        {           
            $values[$name]=format_date((string)$this->getDateTime(),$format);    
        }    
        return $values;
    }  
    
    function getDateFormats()
    {        
        $values=new mfArray();
        foreach (array("ddmmyyyy"=>"a","ddmmyy"=>'d',"ddmmmmyyyy"=>"D","yyyymmdd"=>'yyyyMMdd') as $name=>$format)
        {           
            $values[$name]=format_date((string)$this->getDay(),$format);    
        }    
        return $values;
    }  
    
 
}
