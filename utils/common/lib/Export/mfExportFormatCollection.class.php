<?php

class mfExportFormatCellCollection extends mfArray 
{
    function __construct(Array $values)        
    {      
            $class=str_replace('Collection','',get_called_class());
            foreach ($values as $value)        
                $this[]=new $class($value);            
    }
    
    
    function getValues()
    {
        $values=new mfArray();
        foreach ($this as $cell)
        {
            $values[]=$cell->getValue();
        }   
        return $values;
    }
    
    function getNames()
    {
        $values=new mfArray();
        foreach ($this as $cell)
        {
            $values[]=$cell->getName();
        }   
        return $values; 
    }
}
