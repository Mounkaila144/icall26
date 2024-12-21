<?php

 
class SystemPhpConfig {
   
    
    function getPostMaxSize()
    {
        return ini_get('post_max_size') * 1024 * 1024;
    }
    
    function getMaxExecutionTime()
    {
        return ini_get('max_execution_time');
    }
       
    public  function __call($method,$args) 
    {                
        if (preg_match('~^(get)([A-Z])(.*)$~', $method, $matches)) 
        {            
          $property= strtolower($matches[2]) . $matches[3];
          $field="";
          for ($i=0;$i < strlen($property);$i++)
          { 
              $field.=(ctype_upper($property[$i])?"_":"").strtolower($property[$i]);             
          }
          $fields=ini_get_all();
          if (isset($fields[$field]))
              return ini_get($field);
          if (!property_exists($this, $property))  
              throw new mfException('class '.get_class($this).' => Property ' . $property . ' not exists.');        
        }  
        throw new mfException('class '.get_class($this).' => Method ' . $method . ' not exists.');
    }  
}
