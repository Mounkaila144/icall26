<?php

class mfObjectCollection3 extends mfObjectCollection2 {
    
    
    public function __construct($data=null,$site=null);        
    function addFromRow($key,$row);        
    function implode($separator=",");   
    function hasItemByKey($name);
    function push(mfObject2 $item);
    function hasItem($item);    
    function getItem($item);        
    function getKeys();    
    function toArray();    
    function byIndex();    
    function in($item);    
    function set($name,$value);    
    function get($name,$default=null);     
    function add($values);
}
