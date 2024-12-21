<?php

class AppDomoprimeExportFreeModel extends mfExportFormatModelCell {
    
     protected $title="";     
     
    function __construct($title) {                       
        $this->title=$title;        
    }       
    
    function __toString() {
        return (string)$this->title;
    }
    
    function process($items)
    {              
        $this->output=$this->title;
        return $this;
    }
    
  /*  function getClass()
    {
        return "DomoprimeCalculation";
    }*/
                
}
