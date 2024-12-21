<?php


class ImportStatus {
   
    protected $unknown=null,$count=0;
    
    
    function setUnknown($unknown)
    {
        $this->unknown=$unknown;
        return $this;
    }
    
    function setCount($count)
    {
        $this->count=$count;
        return $this;
    }
    
    function getCount()
    {
        return $this->count;
    }
    
    function getUnknown()
    {
        return $this->unknown;
    }
}

