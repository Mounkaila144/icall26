<?php


class Day {

    static $months=array('january','february','march','april','may','june','july','august','september','october','november','december');
    static $week_days_abbr=array('su','mo','tu','we','th','fr','sa');
    static $week_days=array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
    protected $date="",$schedule=array(); //,$options=array();
    
    function __construct($date=null,$options=array()) {
        if ($date==null)
              $date=date("Y-m-d");
        $this->date=$date;        
      //  $this->options=array_merge(self::getDefaults(),$options);
    }       
    
    static function getInstance($date=null,$options=array())
    {
        return new static($date,$options);
    }
  /*  static function getDefaults()
    {
        return array('class'=>'Time'); 
    }*/
    
    static function getWeekDaysName($from='sunday',$abbr=false)
    {         
        if ($abbr)
            $week_days=self::$week_days_abbr;     
        else
            $week_days=self::$week_days;     
        if ($from=='sunday' || !in_array($from,self::$week_days))
            return $week_days;               
        $key=array_search($from,self::$week_days);
    //     var_dump($key);
        for($i = 0; $i < $key; $i++)                
            array_push($week_days, array_shift($week_days));              
        return $week_days;
    }
    
    static function getMonthsName($from='january')
    {
        $months=self::$months;       
        if ($from=='january' || !in_array($from,$months))
            return $months;                       
        $key=array_search($from,$months);
        for($i = 0; $i < $key; $i++)                
            array_push($months, array_shift($months));              
        return $months;
    }
    
    function getMonthName()
    {         
      return  self::$months[(int)$this->getMonth()-1]; 
    }
    
    function getDayName()
    {
        return self::$week_days[(int)$this->getDayInWeek()];
    }
    
    function getDayNameAbr()
    {
        return self::$week_days_abbr[(int)$this->getDayInWeek()];
    }
    
    function getDate($format="Y-m-d")
    {
        return date($format,strtotime($this->date));
    }
    
    function getDayInWeek()
    {
        return date("w",strtotime($this->date));
    }
    
    function getDayInMonth()
    {
        return $this->_getNumberDayInMonth();
    }
    
    function getDay()
    {
      return date("d",strtotime($this->date));  
    }
    
    function getMonth()
    {
        return date("m",strtotime($this->date));
    }
    
    function getYear()
    {
        return date("Y",strtotime($this->date));
    }
    
    function isBisextile()
    {
        $year=$this->getYear();
        if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0))
             return true;
        return false;
    }
    
    function getNumberOfDayInYear()
    {
        if ($this->isBisextile())
            return 366;
        return 365;
    }
    
    protected function _getNumberDayInMonth()
    {
       return cal_days_in_month(CAL_GREGORIAN, $this->getMonth(), $this->getYear()); 
    }
    
    function getTime()
    {
        return strtotime($this->date);
    }
    
    function getPreviousDay()
    {
       return new $this(date('Y-m-d', strtotime('previous day', strtotime($this->date))));
    }
    
    function getNextDay()
    {
       return new $this(date('Y-m-d', strtotime('next day', strtotime($this->date)))); 
    }
    
    function getPreviousMonthDay()
    {
       return new $this(date('Y-m-d', strtotime('previous month', strtotime($this->date))));       
    }
    
    function getNextMonthDay()
    {      
        if ($this->isLastDay())
        {   
            $day=new $this(date('Y-m-d', strtotime('first day of +1 month', strtotime($this->date))));
            return $day->getLastDayOfMonth();    
        }    
        return new $this(date('Y-m-d', strtotime('next month', strtotime($this->date))));    
    }
    
    function getPreviousYearDay()
    {
        return new $this(date('Y-m-d', strtotime('previous year', strtotime($this->date))));    
    }
    
    function getNextYearDay()
    {
        return new $this(date('Y-m-d', strtotime('next year', strtotime($this->date))));    
    }
    
    function getDayAdd($n)
    {
        return new $this(date('Y-m-d', strtotime($n.' day', strtotime($this->date))));  
    }
    
    function getDaySub($n)
    {
        return new $this(date('Y-m-d', strtotime('-'.$n.' day', strtotime($this->date))));  
    }
    
    function isToday()
    {
        return (date('Y-m-d')==$this->date);
    }
    
    function getFirstDayOfMonth()
    {
        return new $this(date('Y-m-d', strtotime('first day of '.self::$months[$this->getMonth()-1], strtotime($this->date))));  
    }
    
    function getFirstDayOfYear()
    {
        return new $this(date('Y-m-d', strtotime($this->getYear().'-1-1')));  
    }
    
    function getLastDayOfYear()
    {
        return new $this(date('Y-m-d', strtotime($this->getYear().'-12-31')));  
    }
    
    function getLastDayOfMonth()
    {        
        return new $this(date('Y-m-d', strtotime('last day of '.self::$months[$this->getMonth()-1], strtotime($this->date))));  
    }
    
    function isFirstDay()
    {
        return ($this->getDay()==1);
    }
    
    function isLastDay()
    {
        return ($this->getDay()==$this->getDayInMonth());
    }
    
    function __toString() {
        return (string)$this->date;
    }
    
    function getWeekNumber()
    {
       return date("W",strtotime($this->date)); 
    }
    
    function buildSchedule($options=array())
    {      
        $options=array_merge(array('min'=>6,'max'=>23,'scale_day'=>1,'scale_hour'=>0,'class'=>'Time'),(array)$options);       
        $class=$options['class'];
        if ($options['scale_hour']==0)
        {    
            for ($hour=$options['min'];$hour <= $options['max'];$hour+=$options['scale_day'])
            {            
                $key=sprintf("%02d:00",$hour);
                $this->schedule[$key]=new $class($hour,'00');
            }  
        }
        else
        {
            for ($hour=$options['min'];$hour <= $options['max'];$hour+=$options['scale_day'])
            {      
                 if ($hour==$options['max'])
                 {    
                     $key=sprintf("%02d:00",$hour);
                     $this->schedule[$key]=new $class($hour,'00');
                     break;
                 }    
                 for ($minute=0;$minute < 60;$minute+=$options['scale_hour'])
                 {
                    $key=sprintf("%02d:%02d",$hour,$minute);
                    $this->schedule[$key]=new $class($hour,$minute);
                 }   
            }  
        }       
    }
    
    function getSchedule()
    {
       return $this->schedule;
    }
    
    function setSchedule($schedule)
    {
       $this->schedule=$schedule;
       return $this;
    }
    
    function getScheduleTime($time)
    {
        return isset($this->schedule[$time])?$this->schedule[$time]:null;
    }
    
    function getDayTime()
    {
       return new Time(date("H",strtotime($this->date)),date("i",strtotime($this->date)));
    }
    
    function getDayWithTime($time="00:00:00")
    {
        return (string)$this." ".$time;
    }
  /*  function getScheduleDayTime()
    {
       $days=array();
       foreach ($this->schedule as $time)
       {
           $days[]=$this->date." ".$time->getTime();
       }    
       return $days;
    }*/
    
   function getMonthNameI18n()
   {
      return  new mfString(__($this->getMonthName(),array(),'months','utils'));
   } 
    
   function getYearAdd($n)
    {
        return new $this(date('Y-m-d', strtotime($n.' year', strtotime($this->date))));  
    }
    
   function getMonthAdd($n)
    {
        return new $this(date('Y-m-d', strtotime($n.' month', strtotime($this->date))));  
    }
    
    function getMonthSub($n)
    {
        return new $this(date('Y-m-d', strtotime('-'.$n.' month', strtotime($this->date))));  
    }
    
    function getYearSub($n)
    {
        return new $this(date('Y-m-d', strtotime('-'.$n.' year', strtotime($this->date))));  
    }
    
    
    static function getMonthsI18n($from='january')
    {
        $months=array();
        foreach(self::getMonthsName($from) as $month)
                $months[]=__($month,array(),'months','utils');
        return $months;
    }
    
    function getDayNameI18n()
    {
         return new mfString(__($this->getDayName(),array(),'days','utils'));
    }             
    
     static function getDayIndexFromDayName($name,$abbr=false)
    {
         if ($abbr)
             return array_search($name,self::$week_days_abbr);         
        return array_search($name,self::$week_days);         
    }
    
    static function getWeekDaysNameI18n($from='sunday',$abbr=false)
    {              
        $values=array();
         foreach (self::getWeekDaysName($from,$abbr) as $day)
         {                                 
            $values[Day::getDayIndexFromDayName($day,$abbr)]=__($day,array(),($abbr?'days_abbr':'days'),'utils');
         }            
         return $values;
    }
    
     function isWeekEnd()
    {
        if($this->getDayInWeek()==0 || $this->getDayInWeek()==6)
            return TRUE;
        return FALSE;
    }
    
    function getFormatted($format="a")
    {
        return format_date($this->getDate(),$format);
    }        
    
    
    function getStartAndEndDateOfMonth()
    {
        return new mfArray(array('from'=>$this->getFirstDayOfMonth()->getDate(),'to'=>$this->getLastDayOfMonth()->getDate()));
    }
    
    function getFormattedStartAndEndDateOfMonth()
    {
        return new mfArray(array('from'=>$this->getFirstDayOfMonth()->getFormatted(),'to'=>$this->getLastDayOfMonth()->getFormatted()));
    }
    
    function getRange(Day $to)
    {
      //  $offset=$this->getDaySub($to);  
    }
    
    function getFirstDayOfWeek()
    {
        return new $this(date('Y-m-d',strtotime('monday this week', strtotime($this->date))));  
    }
    function getLastDayOfWeek()
    {
        return new $this(date('Y-m-d',strtotime('sunday this week 23:59:59', strtotime($this->date))));  
    }
}
