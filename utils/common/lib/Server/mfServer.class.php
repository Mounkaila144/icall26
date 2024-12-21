<?php


abstract class mfServer implements ArrayAccess {


    protected  $options    = array(), $parameters = null, $attributes = null;
    
   public function __construct($parameters = array(), $attributes = array(), $options = array())
  {
    $this->initialize( $parameters, $attributes, $options);
  }
  
  public function initialize($parameters = array(), $attributes = array(), $options = array())
  {
    $this->options = $options;
    // initialize parameter and attribute holders
    $this->parameters = new mfParameters();
    $this->attributes = new mfParameters();
    $this->parameters->add($parameters);
    $this->attributes->add($attributes);       
  }       
  
  public function getOptions()
  {
    return $this->options;
  }
  
  public function offsetExists($name)
  {
    return $this->hasParameter($name);
  }
  
   public function offsetGet($name)
  {
    return $this->getParameter($name, false);
  }

    public function offsetSet($offset, $value)
  {
    $this->setParameter($offset, $value);
  }
  
  public function offsetUnset($offset)
  {
    $this->getParameter()->remove($offset);
  }
  
   public function getParameters()
  {
    return $this->parameters;
  }

  public function getAttributes()
  {
    return $this->attributes;
  }
  
  public function getAttribute($name, $default = null)
  {
    return $this->attributes->get($name, $default);
  }

  public function hasAttribute($name)
  {
    return $this->attributes->has($name);
  }
  
  public function setAttribute($name, $value)
  {
    $this->attributes->set($name, $value);
    return $this;
  }

  public function getParameter($name, $default = null)
  {
    return $this->parameters->get($name, $default);
  }

  public function hasParameter($name)
  {
    return $this->parameters->has($name);
  }
  
  public function setParameter($name, $value)
  {
    $this->parameters->set($name, $value);
    return $this;
  }
  
  
}

