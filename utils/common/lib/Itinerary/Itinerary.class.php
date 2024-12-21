<?php


class Itinerary extends mfArray {
    
    protected $time=null,$distance=null;
    
    function setTime($time)
    {
        $this->time=$time;
        return $this;
    }
    
    function getTime()
    {
        return $this->time;
    }
    
   
    function setDistance($distance)
    {
        $this->distance=$distance;
        return $this;
    }
    
    function getDistance()
    {
        return $this->distance;
    }
}