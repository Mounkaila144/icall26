<?php

abstract class mfFormatterItemApi extends mfFormatterApi {
     
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
    
    function process()
    {               
        foreach ($this->getData() as $field=>$options)
        {                        
            $this->getWidgets()->pushIf(is_numeric($field)?true:(isset($options['condition'])?$options['condition']:true), new mfWidgetApi($this->getItem(),is_numeric($field)?$options:$field, is_numeric($field)?array():$options));                                            
        }          
        $this->data=$this->getWidgets()->toArray();        
        return $this;
    }
    
    function toArray()
    {
        return $this->data;
    }
    
       
}
    
    
