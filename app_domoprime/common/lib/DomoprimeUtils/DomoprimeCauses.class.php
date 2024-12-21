<?php


class DomoprimeCauses extends mfArray {
    
    function __construct($data = null) {
        if ($data===null)
            return ;        
        if (is_array($data))
             return parent::__construct($data);        
        parent::__construct(explode(',',$data));
    }
    
    function __toString()
    {
        $values=new mfArray();
        foreach ($this->collection as $item)
        {
            $values[]=__('CAUSES_'.$item,array(),'messages','app_domoprime');
        }    
        return (string)$values->implode(',');
    }
  
}
