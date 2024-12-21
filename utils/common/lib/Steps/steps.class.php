<?php

class steps implements ArrayAccess ,Iterator, Countable {
    
    protected $steps=array(),$next=null,$previous=null,$current=null;
    
    function __construct($steps)
    {
        foreach ($steps as $name=>$step)
           $this->steps[$name]=$step;
    }
    
      function getPrevious()
     {
         return $this->previous;
     }
     
     function getNext()
     {
          return $this->next;
     }
     
     
     function hasPrevious()
     {
         return ($this->previous!=null);
     }
     
     function hasNext()
     {
         return ($this->next!=null);
     }          
     
  function add($name,$step,$where=null)
  {
      $this->steps[$name]=$step;
      return $this;
  }   
  
  /* I M P L E M E N T S*/
  
  public function count()
  {
    return count($this->steps);
  }
  
  public function rewind()
  {
    reset($this->steps);
    return $this;
  }
  
  public function key()
  {
    return key($this->steps);
  }

  public function current()
  {
      return current($this->steps);
  }

  public function next()
  {
    next($this->steps);
  }

  public function valid()
  {
    return key($this->steps) !== null;;
  }
  
    public function offsetExists($name) {
        return isset($this->steps[$name]);
    }

    public function offsetGet($name) {
        return isset($this->steps[$name]) ? $this->steps[$name] : null;
    }

    public function offsetSet($name, $value) {
        $this->steps[$name] = $value;
    }
    
     public function offsetUnset($name)
  {
    unset($this->steps[$name]);
  }
  
  function get($name,$default=null)
  {
      return isset($this->steps[$name])?$this->steps[$name]:$default;
  }       
  
  function has($name)
  {
      return isset($this->steps[$name]);
  }
}

