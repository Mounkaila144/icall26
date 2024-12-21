<?php

class old_GPSCoordinates {

    protected $latitude=0,$longitude=0;
    
    function __construct($coordinates) {       
         $coordinates= explode(";",$coordinates);
         $this->latitude=$coordinates[0];
         $this->longitude=$coordinates[1];        
    }
        
    function get($separator=',')
    {        
         return $this->latitude.$separator.$this->longitude;
    }
    
    function getUrlEncode($separator=',')
    {
       return urlencode($this->get($separator));  
    }
    
    function __toString() {
        return (string)$this->get();
    }
    
    function getLatitude()
    {
        return $this->latitude;
    }
    
    function getLongitude()
    {
        return $this->longitude;
    }
    
    function getLonLat($encode=false,$separator='/')
    {
       if ($encode) 
          return urlencode($this->longitude.$separator.$this->latitude);   
       return $this->longitude.$separator.$this->latitude;
    }
    
     function getLatLon($encode=false,$separator='/')
    {
       if ($encode) 
          return urlencode($this->get($separator));   
       return $this->get($separator);
    }
    
}