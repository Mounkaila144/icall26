<?php

class mfFormatterItemApi2 extends mfFormatterApi2 {
     
     protected $options=null;
     
    function __construct($options=null) {             
         $this->options=$options;
         parent::__construct();             
    }
       
    function getOption($name,$default=null)
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }
    
    function getOptions()
    {
       return $this->options; 
    }
    
     
    
    function toArray()
    {
        return $this->data;
    }
    
       
}
    
    
