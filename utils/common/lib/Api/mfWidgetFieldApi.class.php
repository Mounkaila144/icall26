<?php

class mfWidgetFieldApi {
    
    protected $field=null,$parameters=null;
    
    function __construct($field,$parameters=array()) {     
        $this->field=$field;
        $this->parameters=$parameters;
    }
    
    function getField(){
        return $this->field;
    }
            
    function toArray()
    {
        $values=new mfArray($this->parameters);
        unset($values['condition']);
        $values['name']= $this->getField();                
        return $values->toArray();
    }
}
