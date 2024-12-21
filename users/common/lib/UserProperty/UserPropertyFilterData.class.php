<?php


class UserPropertyFilterData extends mfArray{
  
    function __construct($data = null) {
        parent::__construct(json_decode($data,true));
    }    
     
            
    function getColumns(){
        return $this->collection[0];
    }
    
    function getSizes(){
        return $this->collection[1];
    }

}
