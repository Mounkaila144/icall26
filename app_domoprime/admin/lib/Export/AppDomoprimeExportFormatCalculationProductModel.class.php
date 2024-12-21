<?php

class AppDomoprimeExportFormatCalculationProductModel extends mfExportFormatModelCell {
    
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
       if ($items->hasDomoprimeCalculation() && $items->hasDomoprimeProductCalculation() )                
            $this->output=$items->getDomoprimeProductCalculation()->get($this->field);                                 
        else $this->output="";
        return $this;
    }
    
    function getClass()
    {
        return "DomoprimeProductCalculation";
    }
                
}
