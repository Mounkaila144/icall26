<?php


class  SystemReturn extends mfArray
{    
       
    function __construct($values=null) {
        if ($values===null)
            return ;
        if (is_string($values))
        {    
            $this[]=new mfString($values);  
            return ;
        }
        foreach ($values as $value)
            $this[]=new mfString($value);        
    }
    
        
    
}
