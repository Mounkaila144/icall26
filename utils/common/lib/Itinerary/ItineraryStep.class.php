<?php


class ItineraryStep {
 
    protected $origin=null,$destination=null,$time=null,$distance=null;
    
    function __construct($origin,$destination,$distance,$time)
    {
        $this->origin=$origin;
        $this->destination=$destination;
        $this->distance=$distance;
        $this->time=$time;
    }        
    
    function getDistance()
    {
        return $this->distance;
    }
    
    function getTime()
    {
        return $this->time;
    }
 
    function getOrigin()
    {
        return $this->origin;
    }
    
     function getDestination()
    {
        return $this->destination;
    }
}


