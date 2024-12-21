<?php


class CustomerMeetingDayRange extends Day {
    
  /*  protected $installs=array(),$number_of_install=0;
    
    function addInstall($install)
    {
        $this->installs[]=$install;
        return $this;
    }
    
    function getInstalls()
    {
        return $this->installs;
    }
    
    function count()
    {
        return count($this->installs);
    }
    
    function getNumberOfInstalls()
    {
        if (!$this->number_of_install)
        {    
            $this->number_of_install=0;
            foreach ($this->schedule as $install_time)
            {
                if ($install_time->hasInstall())
                {
                    $this->number_of_install+=$install_time->getNumberOfInstalls();
                }    
            }
        }
        return $this->number_of_install;
    }
    
    function buildSchedule()
    {      
        foreach (CustomerContractRange::getRangesI18n() as $range_i18n)
        {                                              
                $this->schedule[$range_i18n->get('range_id')]=new TimeRangeInstall($range_i18n);            
        }          
    }
    
     function getScheduleRange($range_id)
    {
        return isset($this->schedule[$range_id])?$this->schedule[$range_id]:null;
    }
    
    function process()
    {
        $values=array();
        foreach ($this->schedule as $range_id=>$time_range)
        {
            $values[$range_id]=$time_range->getNumberOfInstalls();
        }                  
        $min=min($values);        
        $max=max($values);
        
        $this->schedule[array_search($max,$values)]->setIsHighest();
        $this->schedule[array_search($min,$values)]->setIsLowest();
        
       // echo "<pre>"; var_dump($values); echo "</pre>"; 
        return $this;
    }*/
}

