<?php

class PartnerParameters extends mfArray {
    
    protected $software_name="",$software_editor="",$qualification_reference="",$software_version ="";
   function __construct($data = null) {              
        parent::__construct(json_decode($data,true));
    } 
    
    function get($name,$default=null)
    {
        return isset($this->collection[$name])?$this->collection[$name]:$default;
    }
   
  /* function __call($name, $args=array()) {           
        if(substr($name, 0, 3) == 'get') {            
            $field = strtolower(preg_replace('/(.)([A-Z])/', '$1_$2', lcfirst(substr($name, 3))));
            return $this->get($field);           
        }
        throw new mfException(' Method ' . $name . ' not exists.');
    }*/
    
    function __call($method, $args=array()) {   
        if (preg_match('~^(get|has)([A-Z])(.*)$~', $method, $matches)) {              
                $field = $matches[2]. $matches[3];
               // var_dump($field);
                $field[0] = strtolower($field[0]);                           
                $property = preg_replace_callback('/([A-Z])/', function ($field) { return '_' .strtolower($field[0]); }, $field);                       
                 switch($matches[1]) {                      
                        case 'get':  return $this->get($property);
                        case 'has':  return (boolean)$this->$property;
                 }
                 
        }
         throw new mfException('class '.get_class($this).' => Method ' . $method . ' not exists.');
    }
}
