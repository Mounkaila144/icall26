<?php


class UserPropertyFilterDataBase extends mfArray {
  
    function __construct($data = null) {        
        if ($data)
            parent::__construct($data->decode(true));
        else
           parent::__construct(); 
    }    
     
            
    function getColumns(){
        return $this->collection[0];
    }
    
    function getSizes(){
        return $this->collection[1];
    }

}
