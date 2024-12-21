<?php

/*
 * entry details :
 * .---------------- minute (0 - 59) 
 * |  .------------- hour (0 - 23)
 * |  |  .---------- day of month (1 - 31)
 * |  |  |  .------- month (1 - 12) 
 * |  |  |  |  .---- day of week (0 - 6) (Sunday=0 )
 * |  |  |  |  |
 * *  *  *  *  *
*/         
class cronParser {
    
 	protected   $entry      = array(),	
                    $period     = "",
                    $lastRun    = 0, 		
                    $nextRun    = 0,
                    $year,
                    $month,
                    $day,
                    $hour,
                    $minute,
                    $minutes    = array(),	//minutes array based on cron string
                    $hours      = array(),	//hours array based on cron string
                    $months     = array();	//months array based on cron string

        function __construct($period,$time=null)
        {
            $time=($time===null)?time():$time;
            $this->period=$period;
            $this->entry = @explode("|", $this->period);
            $this->initMinutes();
            $this->initHours();
         //   $this->initDays();
            $this->initMonths(); 
            $this->now = explode(",", strftime("%M,%H,%d,%m,%w,%Y", $time));           
        }
        
	
	protected function expand_ranges($str)
	{
                $ret=array();
		if (strstr($str,  ","))
		{
			$arParts = explode(',', $str);
			foreach ($arParts AS $part)
			{
				if (strstr($part, '-'))
				{
					$arRange = explode('-', $part);
                                        $ret=range($arRange[0],$arRange[1]);
				}
				else
					$ret[] = $part;
			}
		}
		elseif (strstr($str,  '-'))
		{
			$arRange = explode('-', $str);
                        $ret=range($arRange[0],$arRange[1]);
		}
		else
			$ret[] = $str;
		$ret = array_unique($ret);
		sort($ret);
		return $ret;
	}

	function calcLastRun()
	{
		$this->month = NULL;
		$this->day = NULL;
		$this->hour = NULL;
		$this->minute = NULL;
                $this->year = $this->now[5];
		$arMonths = $this->_getMonths();
		do
		{
		    $this->month = array_pop($arMonths);
		}
		while ($this->month > $this->now[3]);
                
		if ($this->month === NULL)
		{
			$this->year--;
			$this->_prevMonth($this->_getMonths());
		}
		elseif ($this->month == $this->now[3]) //now Sep, month = array(7,9,12)
		{
			$arDays = $this->_getDays($this->month, $this->year);
			do
			{
				$this->day = array_pop($arDays);
			}
			while ($this->day > $this->now[2]);
                        
			if ($this->day === NULL)
			{
				$this->_prevMonth($arMonths);
			}
			elseif ($this->day == $this->now[2])
			{
				$arHours = $this->_getHours();
				do
				{
					$this->hour = array_pop($arHours);
				}
				while ($this->hour > $this->now[1]);
				if ($this->hour === NULL) // now =2, arHours = array(3,5,7)
				{
					$this->_prevDay($arDays, $arMonths);
				}
				elseif ($this->hour < $this->now[1]) //now =2, arHours = array(1,3,5)
				{
					$this->minute = $this->_getLastMinute();
				}
				else // now =2, arHours = array(1,2,5)
				{
					$arMinutes = $this->_getMinutes();
					do
					{
						$this->minute = array_pop($arMinutes);
					}
					while ($this->minute > $this->now[0]);
					if ($this->minute === NULL)
					{
						$this->_prevHour($arHours, $arDays, $arMonths);
					}
				}
			}
			else
			{
				$this->hour = $this->_getLastHour();
				$this->minute = $this->_getLastMinute();
			}
		}
		else //now Sep, arrMonths=array(7, 10)
		{
			$this->day = $this->_getLastDay($this->month, $this->year);
			if ($this->day === NULL)
				$this->_prevMonth($arMonths);
			else
			{
				$this->hour = $this->_getLastHour();
				$this->minute = $this->_getLastMinute();
			}
		}
                
             //   echo "Minutes=".$this->minute." Hour=".$this->hour." Day=".$this->day." month=".$this->month." year=".$this->year."\n"; die(__METHOD__);                                
		//if the last due is beyond 1970
		if ($this->minute === NULL)
		{
                        $this->lastRun=false;
		}
		elseif ($this->minute == 'X')
                    $this->lastRun= time();
                else    
		{
			$this->lastRun = mktime($this->hour, $this->minute, 0, $this->month, $this->day, $this->year);
		}                
                return $this->lastRun;
	}

	//get the due time before current month
	protected function _prevMonth($arMonths)
	{
		$this->month = array_pop($arMonths);
		if ($this->month === NULL)
		{
			$this->year--;
			if ($this->year <= 1970)
			{
				
			}
			else
			{
				$this->_prevMonth($this->_getMonths());
			}
		}
		else
		{
			$this->day = $this->_getLastDay($this->month, $this->year);
			if ($this->day === NULL)
			{
				$this->_prevMonth($arMonths);//no available date schedule in this month
			}
			else
			{
				$this->hour = $this->_getLastHour();
				$this->minute = $this->_getLastMinute();
			}
		}

	}

	//get the due time before current day
	protected function _prevDay($arDays, $arMonths)
	{
		
		$this->day = array_pop($arDays);
		if ($this->day === NULL)
		{
			$this->_prevMonth($arMonths);
		}
		else
		{
			$this->hour = $this->_getLastHour();
			$this->minute = $this->_getLastMinute();
		}
	}

	//get the due time before current hour
	protected function _prevHour($arHours, $arDays, $arMonths)
	{
		$this->hour = array_pop($arHours);
		if ($this->hour === NULL)
		{
			$this->_prevDay($arDays, $arMonths);
		}
		else
			$this->minute = $this->_getLastMinute();
	}

	protected function _getLastMonth()
	{
		return array_pop($this->_getMonths());
	}

	protected function _getLastDay($month, $year)
	{
		return  array_pop($this->_getDays($month, $year));
	}

	protected function _getLastHour()
	{
		return  array_pop($this->_getHours());
	}

	protected function _getLastMinute()
	{
		return array_pop($this->_getMinutes());
	}

	//remove the out of range array elements. $arr should be sorted already and does not contain duplicates
	protected function _sanitize ($arr, $low, $high)
	{
		$count = count($arr);
		for ($i = 0; $i <= ($count - 1); $i++)
		{
                    if ($arr[$i] >= $low)
                         break;  
                    unset($arr[$i]);
		}
		for ($i = ($count - 1); $i >= 0; $i--)
		{
                        if ($arr[$i] <= $high)
                            break;
                        unset ($arr[$i]);
		}
		sort($arr);
		return $arr;
	}
        
        protected function _getMinutes()
	{
		return $this->minutes;
	}
        
        protected function _getHours()
        {
           return $this->hours;
        }
        
	//given a month/year, list all the days within that month fell into the week days list.
	protected function _getDays($month, $year = 0)
	{
		if ($year == 0)
		    $year = $this->year;
		$days = array();
		//return everyday of the month if both bit[2] and bit[4] are '*'
		if ($this->entry[2] == '*' AND $this->entry[4] == '*')
			$days = $this->getMonthDays($month, $year);
		else
		{
			//create an array for the weekdays
			if ($this->entry[4] == '*')
			{
                                $arWeekdays=range(0,6);
			}
			else
			{
				$arWeekdays = $this->_sanitize($this->expand_ranges($this->entry[4]), 0, 7);
				//map 7 to 0, both represents Sunday. Array is sorted already!
				if (in_array(7, $arWeekdays))
				{
					if (in_array(0, $arWeekdays))
						array_pop($arWeekdays);
					else
					{
						$tmp[] = 0;
						array_pop($arWeekdays);
						$arWeekdays = array_merge($tmp, $arWeekdays);
					}
				}
			}
			if ($this->entry[2] == '*')
				$daysmonth = $this->getMonthDays($month, $year);
			else
				$daysmonth = $this->_sanitize($this->expand_ranges($this->entry[2]), 1, $this->daysinmonth($month, $year));
			//Now match these days with weekdays
			foreach ($daysmonth AS $day)
			{
				$wkday = date('w', mktime(0, 0, 0, $month, $day, $year));
				if (in_array($wkday, $arWeekdays))
					$days[] = $day;
			}
		}
		return $days;
	}

        protected function _getMonths()
	{
	    return $this->months;
	}
        
        protected function initMinutes()
        {
            if ($this->entry[0] == '*')
                    $this->minutes=range(0,60);
            else
                    $this->minutes = $this->_sanitize($this->expand_ranges($this->entry[0]), 0, 59);
        }
        
        protected function initHours()
	{
            if ($this->entry[1] == '*')
                    $this->hours=range(0,23);
            else
                    $this->hours = $this->_sanitize($this->expand_ranges($this->entry[1]), 0, 23);
	}
        
        protected function initMonths()
        {
            if ($this->entry[3] == '*')
                    $this->months=range(1,12);
            else
                    $this->months = $this->_sanitize($this->expand_ranges($this->entry[3]), 1, 12);
        }
        
        function calcNextRun()
	{
                $this->month = NULL;
		$this->day = NULL;
		$this->hour = NULL;
		$this->minute = NULL;
                $this->year = $this->now[5];
                $this->calcNextMonth();
 	        if ($this->equal) 
 	            $this->addMinute();
 	        $this->nextRun = mktime($this->hour, $this->minute, 0, $this->month, $this->day, $this->year);
                return $this->nextRun;
        }
        
        protected function calcNextMonth()
        {
 	      foreach ($this->_getMonths() as $month)
              {
 	        if ($this->now[3] <= $month) 
                {
 	          if ($this->now[3] < $month) 
                  {    
                      $this->equal = false;
                  }    
 	          $this->month = $month;
 	          $this->calcNextDay();
 	          return ;
 	        }
 	      }
              //le prochain mois n'est pas dans le range en cours,on incrémente mois, on réinitialise le mois à 1 et on recalcule
 	      $this->resetMonth();
 	      $this->calcNextMonth();
        }
        
       protected function resetMonth() 
       {
 	      $this->equal = false;
 	      $this->year++;
 	      $this->now[3] = min($this->months);
       }
       
       protected function calcNextDay() 
       {
 	      $this->initDays();
 	      foreach ($this->days as $day) 
              {
                  if ($this->now[2] <= $day) 
                  {
                    if ($this->now[2] < $day) 
                        $this->equal = false;
                    $this->day = $day;
                    $this->calcNextHour();
                    return ;
                  }
 	      }
 	      $this->resetDay();
      }
 	
	
      protected  function resetHour() 
      {
 	      $this->equal = false;
 	      $this->now[1] = min($this->hours);
 	      $this->addDay();
      }
 	
      protected function addHour() 
      {
 	    $this->equal = false;
 	    if ($this->hour == max($this->hours)) 
            {
 	      $this->resetHour();
 	    } 
            else 
            {
 	      $this->now[1]++;
 	      $this->calcNextHour();
 	    }
      }
      
       protected function calcNextHour() 
       {
         foreach ($this->hours as $hour) 
         {
 	        if ($this->now[1] <= $hour) 
                {
                    if ($this->now[1] < $hour) 
                        $this->equal = false;
                    $this->hour = $hour;
                    $this->calcNextMinute();
                    return ;
 	        }
 	 }
         $this->resetHour();
      }
 	
      protected function resetMinute() 
      {
          // Issue with minute 0|19|*|*|* 
          //echo "Minutes=".$this->minute." Hour=".$this->hour." Day=".$this->day." month=".$this->month." year=".$this->year." entry[2]".$this->entry[2]." entry[4]".$this->entry[4]."\n"; die(__METHOD__);                                
 	      $this->equal = false;
 	      $this->now[0] = min($this->minutes);
 	      $this->addHour();
      }
 	
      protected function addMinute() 
      {
 	    $this->equal = false;
 	    if ($this->minute == max($this->minutes)) 
            {
 	      $this->resetMinute();
	    } 
            else 
            {
 	      $this->now[0]++;
 	      $this->calcNextMinute();
 	    }
      }
 	
      protected function calcNextMinute() 
      {
 	      foreach ($this->minutes as $min) 
              {
                    if ($this->now[0] <= $min)
                    {
                      if ($this->now[0] < $min) 
                          $this->equal = false;
                      $this->minute = $min;
                      return ;
                    }
 	      }
 	      $this->resetMinute();
     }
     
     protected function initDays() 
     {
        $month = $this->month;
        $year = $this->year;
        //return everyday of the month if both bit[2] and bit[4] are '*'
        if ($this->entry[2] == '*' AND $this->entry[4] == '*') 
        {
            $days = $this->getMonthDays($month, $year);
        } 
        else 
        {
            //create an array for the weekdays
            if ($this->entry[4] == '*') 
            {
                $arWeekdays=range(0,6);
            } 
            else 
            {
                $arWeekdays = $this->_sanitize($this->expand_ranges($this->entry[4]), 0, 7);

                //map 7 to 0, both represents Sunday. Array is sorted already!
                if (in_array(7, $arWeekdays)) {
                    if (in_array(0, $arWeekdays)) {
                        array_pop($arWeekdays);
                    } else {
                        $tmp[] = 0;
                        array_pop($arWeekdays);
                        $arWeekdays = array_merge($tmp, $arWeekdays);
                    }
                }
            }

            if ($this->entry[2] == '*') 
            {
                $daysmonth = $this->getMonthDays($month, $year);
            } 
            else 
            {
                $daysmonth = $this->_sanitize($this->expand_ranges($this->entry[2]), 1, $this->getNbDaysInMonth($month, $year)); // so that we do not end up with 31 of Feb
            }
            $days = array();
            //Now match these days with weekdays
            foreach ($daysmonth AS $day) {
                $wkday = date('w', mktime(0, 0, 0, $month, $day, $year));
                if (in_array($wkday, $arWeekdays)) {
                    $days[] = $day;
                }
            }
        }
     //   $days=$this->_sanitize ($days, 1, $this->getNbDaysInMonth($month, $year)); 
        if (!count($days)) 
        {
            $this->count_invalid_day_range++;
        }
        if ($this->count_invalid_day_range == 12) {
            throw new mfException('Day range is not valid');
        }
        $this->days = $days;
    }
    
    //given a month/year, return an array containing all the days in that month
    protected function getMonthDays($month, $year) 
    {
         return range(1,$this->getNbDaysInMonth($month, $year));
    }

    protected function getNbDaysInMonth($month, $year) 
    {
 	 return date('t', mktime(0, 0, 0, $month, 1, $year));
    }

    protected function addDay() 
    {
            $this->equal = false;
 	    if ($this->now[2] == max($this->days)) 
            {        
 	      $this->resetDay(); //ne pas lancer le calcNextDay car resetDay lance addMonth qui appel calcNextMonth qui appel calcNextDay
 	    } 
            else 
            {
 	      $this->now[2]++;
 	      $this->calcNextDay();
 	    }
    }
    
    protected function resetDay() 
    {
          $this->equal = false;
          $this->now[2] = 1;
          $this->addMonth();
    }
    
    protected function addMonth() 
    {
          $this->equal = false;
          if ($this->now[3] == max($this->months)) 
          {
            $this->resetMonth();
          } 
          else 
          {
            $this->now[3]++;
          }
          $this->calcNextMonth();
    }
    
    public function getLastRunTime()
    {
           return date("Y-m-d H:i:s",$this->getLastRun()); 
    }

    public function getLastRun()
    {
	     return $this->lastRun;
    }
    
    public function getNextRun()
    {
           return $this->nextRun; 
    }
        
    public function getNextRunTime()
    {
           return date("Y-m-d H:i:s",$this->getNextRun()); 
    }

    

}
