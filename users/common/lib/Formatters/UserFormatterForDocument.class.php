<?php


class UserFormatterForDocument extends mfArray {
   
    
    
    function __toString() {
        return (string)$this['firstname']." ".$this['lastname'];
    }
}
