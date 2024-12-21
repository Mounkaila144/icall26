<?php

class SiretFormatter extends mfArray {
    
    
       function __construct($data = null) {                      
           parent::__construct(str_split($data,3));
       }
    
    
       function __toString() {
           return (string)$this->implode("");
       }
    
    
}
