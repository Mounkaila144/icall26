<?php

class AppDomoprimeExportFormatProductModel extends mfExportFormatModelCell {
    
     protected $title="";     
     
    function __construct($field,$title) {               
        parent::__construct(null, $field);
        $this->title=$title;        
    }       
    
    function __toString() {
        return (string)$this->title;
    }
    
    function process($items)
    {                      
       if ($items->hasDomoprimeProductCalculation())
       {
           $this->output=format_number($items->getDomoprimeProductCalculation()->get($this->field),'#0');
       }      
       else
       {
           $this->output="";
       }    
        return $this;
    }
    
    function getClass()
    {
        return "DomoprimeProductCalculation";
    }
                
}
