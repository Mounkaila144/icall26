<?php

class step implements ArrayAccess {
    
    public $enabled=true,$authorized=false,$name="";
    
    function __construct($name,$properties=array()) {
        $this->name=$name;
        foreach ($properties as $name=>$value)
           $this->$name=$value;
    }
    
    function set($name,$value)
    {
       $this->$name=$value;
       return $this;
    }        
    
    function get($name,$default=null)
    {
        return isset($this->$name)?$this->$name:$default;
    }
    
     public function offsetExists($name) {
        return isset($this->$name);
    }

    public function offsetGet($name) {
        return isset($this->$name) ? $this->$name : null;
    }

    public function offsetSet($name, $value) {
        $this->$name = $value;
    }
    
     public function offsetUnset($name)
  {
    unset($this->$name);
  }
  
    public function disable()
    {
        $this->enabled=false;
        return $this;
    }        
    
    public function enable()
    {
        $this->enabled=true;
        return $this;
    } 
    
    public function isEnabled()
    {
        return $this->enabled;
    }
    
    public function isDisabled()
    {
        return !$this->enabled;
    }
    
    public function isAuthorized()
    {
        return $this->authorized;
    } 
    
    public function authorized()
    {
       $this->authorized=true; 
       return $this;
    }  
    
     public function notAuthorized()
    {
       $this->authorized=false; 
       return $this;
    }  
    
    
}

