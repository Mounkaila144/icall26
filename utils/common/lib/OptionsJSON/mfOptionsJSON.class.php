<?php

class mfOptionsJSON {
    
    protected $options=array();
    
    function __construct($options=array()) {
        $this->options=$options;
    }
    
    function toJSON($defaults=array(),$fields=array())
    {
        if ($fields)
        {    
            $options=$defaults;
            foreach ($fields as $field)
            {
                if (isset($this->options[$field]))
                   $options[$field]=$this->options[$field];
            }
        }
        else
           $options=array_merge($defaults,$this->options);
        //echo "</script>";var_dump($options);        
        return json_encode($options);
    }
    
}
