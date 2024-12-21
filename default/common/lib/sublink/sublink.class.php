<?php

class sublink {

    protected $link=array();
    
    function __construct($link=array()) {
        if ($link!=null)
            $this->set($link);
    }
    
    function set($data)
    {
        $this->link=$data;
    }
    
    function get($name)
    {
        return isset($this->link[$name])?$this->link[$name]:null;
    }
    
}

