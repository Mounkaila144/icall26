<?php


class tab implements ArrayAccess {
   
    protected $properties=array(),$name="";
        
    function __construct($name,$properties=array())
    {
        $this->name=$name;
        $this->properties=$properties;                
    }
    
    public function offsetSet($offset, $value) {
        $this->properties[$offset]=$value;
    }
    
    public function offsetExists($offset) {
        return $this->has($offset);
    }
    
    public function offsetUnset($offset) {
        unset($this->properties[$offset]);
    }
    
    public function offsetGet($offset) {
       return $this->get($offset);
    }
    
    function has($name)
    {   
       return isset($this->properties[$name])?true:false;
    }
    
    function getProperties()
    {     
       return isset($this->properties)?$this->properties:null;
    }
    
    function set($name,$value)
    {
       $this->properties[$name]=$value;
       return $this;
    }   
    
    function get($name,$default=null)
    {
         return $this->has($name)?$this->properties[$name]:$default;
    }
    
    function getComponent($method,$parameters=array(),$default=false)
    {
       if (!$this->has('component'))
           return $default;
       $smarty=mfContext::getInstance()->getController()->getActionStack()->getLastEntry()->getActionInstance()->getViewManager();
       $component=mfContext::getInstance()->getComponentController()->dispatch($this->get('component'),array(),$smarty);        
       if (method_exists($component,$method))
          return $component->$method($parameters);
       return $default;      
    }
    
    function getRoute()
    {               
        $route=$this->get('route');         
        if (is_array($route))
            return url_to(key($route),current($route));
        return url("");
    }
    
    function getRouteAjax()
    {        
        $route=$this->get('route_ajax');         
        if (is_array($route))
            return url_to(key($route),current($route));
        return url("");
    }
}

