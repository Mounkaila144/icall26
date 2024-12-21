<?php

class mfExportFormatCell {
    
    protected $name="",$value="",$title="";
    
    function __construct($values=array())
    {        
        $this->name=isset($values['name'])?$values['name']:"";
        $this->value=isset($values['value'])?$values['value']:"";
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getValue()
    {
        return $this->value;
    }
    
    function getTitle()
    {
        return $this->title;
    }
    
    function setTitle($title)
    {
        $this->title=$title;
        return $this;
    }
    
}
