<?php


class sublinks implements ArrayAccess,Iterator,countable {
    
    protected $links=array(),$search,$menu,$field,$position=0;
    
    function __construct($menu=null,$field=null,$search=null) {
       $this->menu=$menu;
       $this->field=$field;
       $this->search=$search;
    }
    
    function setMenu($menu)
    {
        $this->menu=$menu;
    }
    
    function build() //$field=null,$search=null)
    {
       $this->_build($this->menu);
       if ($this->links)
           $this->sort();    
    }   
    
    protected function add($link)
    {
       $this->links[]=new sublink($link);
    }
    
    protected function _build($menu)
    {       
         if ($menu->get($this->field)==$this->search)    
         {
             $this->add($menu->getProperties());
             return true;
         }
         else
         {
             foreach ($menu as $child)
             {
               //   var_dump($menu);
                  if ($this->_build($child))
                  {   
                      if ($menu->has($this->field))
                          $this->add($menu->getProperties());
                      return true;
                  }   
             }    
         }    
         return false;
    }
    
    protected function sort()
    {
       krsort($this->links,SORT_NUMERIC);
    }
    
     function rewind() {  
        reset($this->links);
        $this->position = key($this->links);
    }

    function current() {
        return $this->links[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        next($this->links);
        $this->position=key($this->links);
    }

    function valid() {
        return isset($this->links[$this->position]);
    }
    
    function has($name)
    {
        return isset($this->links[$name]);
    }
    
    function get($name)
    {
         return $this->has($name)?$this->links[$name]:null;
    }
    
    public function offsetSet($offset, $value) {
    }
    
    public function offsetExists($offset) {
        return $this->has($offset);
    }
    
    public function offsetUnset($offset) {
    }
    
    public function offsetGet($offset) {
       return $this->get($offset);
    }
    
    public function count()
    {
        return count($this->links);
    }
    
    public function getLinks()
    {
        return $this->links;
    }
}

