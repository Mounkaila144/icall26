<?php

abstract class mfFormatterFilterItemApi2 extends mfFormatterItemApi2 {
     
     protected $filter=null;
    
    function __construct($item,$filter=null) {                    
         $this->item=$item;   
         $this->filter=$filter;
         parent::__construct();             
    }
    
    function getItem()
    {
        return $this->item;
    }
    
    
    function getFilter()
    {
       return $this->filter; 
    }
     
}
    
    
