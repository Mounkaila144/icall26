<?php


abstract class  SystemCore
{

    protected $options=array(),$errors=array(),$return=null,$debug=false;
       
    function __construct($options=array()) {
        $this->options= $options instanceof mfArray?$options:new mfArray($options);        
        $this->return=new SystemReturn();
        $this->errors=new mfArray();
    }
    
        
    abstract function getVersion();
    
    function debug()
    {
        $this->debug=true;
        return $this;
    }
    
    function isDebug()
    {
        return $this->debug;
    }
    
    static function getInstance()
    {
        if (static::$instance===null)   
        {
            static::$instance=new static();
        }    
        return static::$instance;
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
    
    function addOption($value)
    {
        $this->options[]=$value;
        return $this;
    } 
    
    
     function getOption($name,$default=null)
    {
        return isset($this->options[$name]) ?$this->options[$name]:$default;      
    } 
    
    function addOptions($options)
    {
        foreach ($options as $name=>$value)
          $this->setOption ($name, $value);
        return $this;
    }
    
    function setOptions($options)
    {
        $this->options=$options;
        return $this;
    }  
                
    function hasErrors()
    {
        return !$this->getErrors()->isEmpty();
    }
    
     function getErrors()
    {
        return $this->errors;
    }            

    function getCommand()
    {
        return "?";
    }
    
    function execute($cmd="",$options="")
    {
        return "?";
    }
    
    function getReturn()
    {
        return $this->return;
    }
}
