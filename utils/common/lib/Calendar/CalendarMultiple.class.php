<?php

class CalendarMultiple implements ArrayAccess ,Iterator, Countable {
       
    protected $calendars=array();    
    protected $options=array(),                         
              $date_start=null;
    
    function __construct($start=null,$options=array())
    {
        $this->options=array_merge($this->getDefaults(),$options); 
        if ($start==null)
            $start=date("Y-m-d",time());
        $this->date_start=new Day($start);                      
        $this->configure();     
    }
    
    function configure()
    {
        $this->build();
    }
    
    function getDefaults()
    {
       return array('autocomplete'=>true,
                    'start_day'=>'sunday',
                    'number_of_month'=>1,
                    'line'=>6,
                    'abbr_day'=>false,
                    'offset_day'=>0);  
    }
          
    function build()
    {    
       $this->calendars=array();
       $date_start=$this->date_start;
       for ($i=0;$i<$this->options['number_of_month'];$i++)
       {           
          $this->calendars[]=new Calendar($date_start->getDate(),$this->options);  
          $date_start=$date_start->getNextMonthDay();
       }           
        
    }
    
    function getCalendars()
    {
        return $this->calendars;
    }
     
    
    function getFirst()
    {
        return $this->calendars[0];
    }
    
    function getLast()
    {
        return end($this->calendars);
    }
    
    public function count()
  {
    return count($this->calendars);
  }
  
  public function rewind()
  {   
    reset($this->calendars);
  }

  public function key()
  {     
      return key($this->calendars);
  }

  public function current()
  {    
      return current($this->calendars);
  }

  public function next()
  {  
      return next($this->calendars);
  }

  public function valid()
  {    
       $key = key($this->calendars);
       return ($key !== NULL && $key !== FALSE);
  }
  
  public function offsetSet($offset, $value)
  {      
     $this->calendars[$offset]=$value;  
  }

  public function offsetUnset($offset)
  {
      unset($this->calendars[$offset]);     
  }
  
   public function offsetExists($name)
  {
    return isset($this->calendars[$name]);
  }

  public function offsetGet($name)
  {
     return $this->calendars[$name]; 
  }
  
  
}

