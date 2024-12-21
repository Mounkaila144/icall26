<?php

class mfExportFormatModelCell {
    
    static $separator_number=',';
    
    protected $class="",$field=null,$output="";
    
    function __construct($class="",$field=null) {       
        $this->class=$class;
        $this->field=$field;                  
    }     
    
    function processCell($item)
    {                       
       $this->output=$item->get($this->field);      
       return $this;
    }
    
    function process($items)
    {                     
        if (is_string($this->getClass()))
        {        
            $has_method="has".$this->getClass();          
            if ($items->$has_method())
            {          
                $get_method="get".$this->getClass();              
                $this->processCell($items->$get_method());
            }  
            else
            {
               $this->output=  $this->getNotExistingOutput(); 
            }
        }
        elseif (is_array($this->getClass()))
        {            
            $alias = key($this->getClass());               
            if ($items->get($alias))
            {                                  
                $this->processCell($items->get($alias));
            }  
            else
            {
               $this->output=  $this->getNotExistingOutput(); 
            }
        }    
        return $this;
    }
    
    function getClass()
    {
        return  $this->class;
    }
    
    function getOutput()
    {
        return (string)$this->output;
    }
    
    function getNotExistingOutput()
    {
        return "";
    }
}
