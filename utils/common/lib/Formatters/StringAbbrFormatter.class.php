<?php

class StringAbbrFormatter extends mfArray {
    
    
       
       function __toString() {
           return (string)$this['value'];
       }
    
    
}
