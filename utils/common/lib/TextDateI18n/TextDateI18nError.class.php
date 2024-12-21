<?php

class TextDateI18nError {
    
    protected $value="";
    protected $error="";
    
    function __construct($value,$error) {
        $this->value = $value;
        $this->error= $error;
    }
    
    function getValue()
    {
        return $this->value;
    }
    
    function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    
    function getError()
    {
        return $this->error;
    }
    
    function setError($error)
    {
        $this->error = $error;
        return $this;
    }
    
    
}
