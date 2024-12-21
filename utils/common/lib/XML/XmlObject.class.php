<?php

class XMLObject {
    
    protected $value=null,$options=array();
    
    function __construct(mfObject2 $value,$options=array()) {
        $this->value=$value;
        $this->options=$options;
    }
    
    function getOption($name,$default=null)
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }       
    
    function getItem()
    {
        return $this->value;
    }
    
    function getOptions()
    {
        return $this->options;
    }
    
    function setOption($name,$value)
    {
        $this->options[$name]=$value;
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
        $this->output='<'.$this->getOption('name').'>';       
        foreach ($this->value->toXML() as $field=>$value)
        {            
            if (is_array($value) || $value instanceof ArrayAccess)                        
               $value=$this->ArrayToXml($value);            
            elseif ($value instanceof mfObject2)                          
               $value=$this->ArrayToXml($value->toXml());  
            $this->output.=sprintf("<%s>%s</%s>",$field,$value,$field);                       
        } 
        $this->output.='</'.$this->getOption('name').'>';      
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
}

