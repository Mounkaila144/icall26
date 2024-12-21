<?php

class mfWidgetApiCollection extends mfArray {
    
    function pushIf($condition,mfWidgetApi $widget)
    {
        if ($condition)
            $this->push($widget);        
        return $this;
    } 
    
    function setIf($condition,$name,mfWidgetApi $widget)
    {
        if ($condition)
            $this->set($name,$widget);        
        return $this;
    } 
    
    
    function toArray()
    {        
        $values=array();
        foreach ($this as $item)
           $values[]=$item->toArray();
        return $values;
    }
    
}
