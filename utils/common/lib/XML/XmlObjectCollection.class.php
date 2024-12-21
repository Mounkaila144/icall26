<?php

class XMLObjectCollection {
    
    protected $value=null,$options=array(),$name="";
    
    function __construct($name,mfObjectCollection2 $value,$options=array()) {
        $this->value=$value;
        $this->name=$name;
        $this->options=$options;
    }
    
    function getOption($name,$default=null)
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }       
    
    function getOptions()
    {
        return $this->options;
    }
    
    function setOption($name,$value)
    {
        $this->option[$name]=$value;
        return $this;
    }        
    
    protected function ArrayToXml($values)
    {
        $output='';
        foreach ($values as $field=>$value)
        {
            if (is_array($value))    
                $value=$this->ArrayToXml ($value);
           $output.=sprintf("<%s>%s</%s>",$field,$value,$field);     
        }
        return $output;
    }
    
    function toXML()
    {
        $this->output='<'.$this->name.'s>';              
        foreach ($this->value->toXml() as $value)
        {                        
            if (is_array($value) || $value instanceof ArrayAccess)                        
               $value=$this->ArrayToXml($value);                       
            $this->output.=sprintf("<%s>%s</%s>",$this->name,$value,$this->name);                       
        } 
        $this->output.='</'.$this->name.'s>';      
        return $this;
    }
    
    
    function output()
    {
        return $this->output;
    }
    
    function getFilename()
    {
        return $this->getOption('path')."/".$this->getName();
    }
    
    function getName()
    {
        return $this->getOption('name').($this->getOption('extension')?".".$this->getOption('extension'):'.xml');
    }
    
    function save()
    {            
        $file=new File($this->getFilename());
        $file->putContent($this->getOption('open','<?xml version="1.0" encoding="UTF-8" ?>').$this->toXML()->output().$this->getOption('close'));
        return $this;
    }
    
    function getValue()
    {
        return $this->value;
    }
}

