<?php

class DateFormatter extends Day {
    
    function __construct($date=null,$options=array()) {        
        $this->date=$date;              
    }   
    
    function __toString() {
        return (string)$this->getText();
    }
    
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
    
    function getFormatted($format='a')
    {
        return format_date($this->date,$format);
    }
    
    function getExport()
    {      
        if (!$this->date) return "";
        $values=array();
        foreach (array("ddmmyyyy"=>"a","ddmmyy"=>'d',"ddmmmmyyyy"=>"D","yyyymmdd"=>'yyyyMMdd') as $name=>$format)
        {           
            $values[$name]=format_date($this->date,$format);    
        }    
        return $values;
    }  
    
     function getExportPdf()
    {      
        if (!$this->date) return "";
        $values=array();
        foreach (array("ddmmyyyy"=>"a","ddmmyy"=>'d',"ddmmmmyyyy"=>"D","yyyymmdd"=>'yyyyMMdd') as $name=>$format)
        {           
            $values[$name]=new mfString(format_date($this->date,$format));    
        }    
        return $values;
    }  
}
