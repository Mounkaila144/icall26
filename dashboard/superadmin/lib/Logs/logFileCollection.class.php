<?php


class logFileCollection {
    
    protected $collection=array();
    
    function __construct($collection=array())
    {
        $this->collection=$collection;
    }
    
    function delete()
    {
        foreach ($this->collection as $item)
        {
            //var_dump($item);
            $item->delete(); 
        }    
    }
}

