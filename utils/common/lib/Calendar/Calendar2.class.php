<?php

class Calendar2 implements ArrayAccess {
     
    protected $week_days_name=array();
    protected $options=array(),   
              $days=array(),  
              $hours=array(),            
              $start=null,$end=null,
              $calendars=array(),
              $date_start="";
                 
    function __construct($start=null,$options=array())
    {
        $this->options=array_merge(self::getDefaults(),$options);       
        if ($start==null)
            $start=date("Y-m-d",time());               
        $class=$this->options['class'];               
        $this->date_start=new $class($start);  
        if ($this->getOption('hours')!==null)
            $this->date_start->buildSchedule($this->getOption('hours'));
        $this->week_days_name=$class::getWeekDaysName($this->options['start_day'],$this->options['abbr_days']);         
        $this->configure();
    }  
    
    static function getStartAndEndDates($start_at,$options=array())             
    {
        $start_at=new Day2($start_at);           
        $options=array_merge(self::getDefaults(),$options);
        if ($options['mode']=='week')
        {
            $start_day=array_search($options['start_day'],Day2::getWeekDaysName());
            $offset=$start_at->getDaySub($start_day-1)->getDayInWeek();  
            $date_start=$start_at->getDaySub($offset);
            $date_end=$start_at->getDayAdd(6-$offset);
        } 
        elseif ($options['mode']=='month')
        {            
            $start_day=array_search($options['start_day'],Day2::getWeekDaysName());          
            $offset=$start_at->getDaySub($start_at->getDay()+$start_day)->getDayInWeek();  
            if ($options['autocomplete'])
            {                             
               $date_start=$start_at->getDaySub($start_at->getDay()+$offset);                 
               $rest=7 * $options['line'] - ($start_at->getDayInMonth()+$offset+1) ;      
               $date_end=$date_start->getDayAdd($start_at->getDayInMonth()+$rest+$offset); 
            }   
            else
            {
               $date_start=$start_at;
               $date_end=$start_at->getLastDayOfMonth();
            }    
        } 
        elseif ($options['mode']=='year')
        {
            $date_start=$start_at->getFirstDayOfYear();
            $date_end=$start_at->getLastDayOfYear();
        }   
        else
        {
               $date_start=$start_at;
               $date_end=$start_at;
        }
        return array($date_start,$date_end);
    }       
    
    protected function configure()
    {
        $this->build();
    }
    
    function getOption($name,$default=null)
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }
    
    function getDate()
    {
        return $this->date_start;
    }
    
    static protected function getDefaults()
    {
       return array('autocomplete'=>true,
                    'start_day'=>'sunday',
                    'start_first_day'=>true,
                    'class'=>'Day',
                    'mode'=>'month',
                    'line'=>6,
                    'abbr_days'=>false,
                    'hours'=>null,
                    'offset_day'=>0); 
    }
    
    function getDays()
    {
        return $this->days;
    }
    
    function getWeekDaysName()
    {        
        return $this->week_days_name;        
    }
      
    protected function buildMonthFromStart()
    {
        $class=$this->options['class'];              
        $this->date_start=$this->date_start->getFirstDayOfMonth();
        // 0 -> Offset
         $class_collection=$this->getOption('class_collection','mfArray');       
        $this->days=new $class_collection();                 
        for ($i=0;$i<$this->date_start->getLastDayOfMonth()->getDay();$i++)
        {           
            $date=$this->date_start->getDayAdd($i);                          
            if ($this->getOption('hours')!==null)
            {                             
                $date->buildSchedule($this->getOption('hours'));           
            } 
            $this->days[$date->getDate()]=$date; 
        }                   
        $this->start=$this->date_start;
        $this->end=$this->date_start->getLastDayOfMonth();  
        return $this;
    }   
    
    protected function buildMonth()
    {               
        if ($this->options['start_first_day'])
            return $this->buildMonthFromStart();
          $class=$this->options['class'];
        $start_day=array_search($this->options['start_day'],$class::getWeekDaysName());
        $offset=$this->date_start->getDaySub($this->date_start->getDay()+$start_day)->getDayInWeek();       
        // 0 -> Offset
         $class_collection=$this->getOption('class_collection','mfArray');
        $this->days=new $class_collection();              
        for ($i=0;$i<=$offset;$i++)
        {
            if ($this->options['autocomplete']==true)
            {    
                $date=$this->date_start->getDaySub($this->date_start->getDay()+$offset-$i);
                $this->days[]=$date;               
            }    
            else
                $this->days[]=null;
        }               
        // Offset - end of month
        for ($i=1;$i<=$this->date_start->getDayInMonth();$i++)
        {
            $date=$this->date_start->getDaySub($this->date_start->getDay()-$i);
            $this->days[]=$date;           
        }
        $next_month=$this->date_start->getNextMonthDay()->getFirstDayOfMonth();         
        $rest=7 * $this->options['line'] - count($this->days);      
        // Complete -> end of array            
        for ($i=0;$i<$rest;$i++)
        {
            if ($this->options['autocomplete']==true)
            {    
                $date=$next_month->getDayAdd($i);
                $this->days[]=$date;                               
            }    
            else
                $this->days[]=null;
        }   
        if ($this->options['autocomplete']==true)
        {                               
             $this->start=$this->date_start->getDaySub($this->date_start->getDay()+$offset);                 
             $rest=7 * $this->options['line'] - ($this->date_start->getDayInMonth()+$offset+1) ;              
             $this->end=$this->start->getDayAdd($this->date_start->getDayInMonth()+$rest+$offset); 
        }
        else
        {
             $this->start=$this->date_start->getFirstDayOfMonth();
             $this->end=$this->date_start->getLastDayOfMonth();
        }    
        return $this;
    }
    
    protected function buildWeek()
    {
        $class=$this->options['class'];
        $start_day=array_search($this->options['start_day'],$class::getWeekDaysName());
        $offset=$this->date_start->getDaySub($start_day)->getDayInWeek();       
        // 0 -> Offset   
        $class_collection=$this->getOption('class_collection','mfArray');
        $this->days=new $class_collection();               
        for ($i=0;$i<$offset;$i++)
        {
            $date=$this->date_start->getDaySub($offset-$i);           
            if ($this->getOption('hours')!==null)
            {                             
                $date->buildSchedule($this->getOption('hours'));           
            }    
            $this->days[$date->getDate()]=$date;           
        }           
        // Offset - end of week
        for ($i=0;$i< (7 - $offset);$i++)
        {
            $date=$this->date_start->getDayAdd($i);     
            if ($this->getOption('hours')!==null)
                $date->buildSchedule($this->getOption('hours'));
            $this->days[$date->getDate()]=$date;                     
        }         
        $this->start=$this->date_start->getDaySub($offset);
        $this->end=$this->date_start->getDayAdd(6-$offset);   
        if ($this->getOption('hours')!==null)
            $this->end->buildSchedule($this->getOption('hours'));
    }
    
    protected function buildYear()
    {       
       $this->calendars=new CalendarMultiple($this->date_start->getFirstDayOfYear()->getDate(),array_merge($this->options,array('number_of_month'=>12,'mode'=>'month','autocomplete'=>false)));    
    }
    
    protected function buildDay()
    {               
      //  $class_collection=$this->getOption('class_collection','mfArray');
      //  $this->days=new $class_collection();                
        $this->days[$this->date_start->getDate()]=$this->date_start; 
        $this->start=$this->date_start; 
        $this->end=$this->date_start; 
        $this->date_start->buildSchedule($this->getOption('hours'));
    }
    
   
    
    protected function buildDays()
    {
        
    }        
    
    
    
    
    
    function getCalendars()
    {
        return $this->calendars;
    }
    
    function isYearMode()
    {
        return ($this->options['mode']=='year');
    }
    
    function isDayMode()
    {
        return ($this->options['mode']=='day');
    }
    
    function isMonthMode()
    {
        return ($this->options['mode']=='month');
    }
    
     function isWeekMode()
    {
        return ($this->options['mode']=='week');
    }
    
    
    function build()
    {       
        if ($this->getOption('mode','month')=='month')
           return $this->buildMonth();     
        if ($this->getOption('mode')=='week')
            return $this->buildWeek();
        if ($this->getOption('mode')=='year')
            return $this->buildYear();
        if ($this->getOption('mode')=='day')
            return $this->buildDay();    
         if ($this->getOption('mode')=='days')
            return $this->buildDays();    
    }
    
    function getFirstDay()
    {     
        if ($this->getOption('mode')=='year')
        {
            return $this->calendars->getFirst()->getFirstDay();           
        }    
        return $this->start;
    }
   
    function getLastDay()
    {
        if ($this->getOption('mode')=='year')
        {                 
            return $this->calendars->getLast()->getLastDay();   
        }    
        return $this->end;
    }
  
    function getHours()
    {
        $date=new Day2();
        $date->buildSchedule($this->getOption('hours'));
        return $date->getSchedule();
    }
    
    function getDay($day)
    {
        return isset($this->days[$day])?$this->days[$day]:null;
    }
    
     public function offsetExists($name)
  {
    return isset($this->days[$name]);
  }

  public function offsetGet($name)
  {   
    return isset($this->days[$name])?$this->days[$name]:null;
  }

  public function offsetSet($offset, $value)
  {
    throw new LogicException('Cannot update form fields (read-only).');
  }

  public function offsetUnset($offset)
  {
    throw new LogicException('Cannot remove form fields (read-only).');
  }
  
  function getDayWithTime(DayTime2 $day_time,$second=false)
  {                    
     if (!$day=$this->getDay($day_time->getDay()->getDate()))      
          return null; 
    // if ($second===false)     
    //    return $day->getScheduleTime($day_time->getTime()->getHourMinute());
     return $day->getScheduleTime($day_time->getTime()->getTime());
  }
  
}

