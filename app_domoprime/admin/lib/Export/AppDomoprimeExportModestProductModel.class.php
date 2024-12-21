<?php

class  AppDomoprimeExportModestProductModel extends mfExportFormatModelCell {
    
     protected $title="";
     static protected $classic=null;
     
    function __construct($field,$title) {               
        parent::__construct(null, $field);
        $this->title=$title;
        if (self::$classic===null)
        {
            self::$classic= DomoprimeSettings::load()->get('classic_class');
        }    
    }       
    
    function __toString() {
        return (string)$this->title;
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation() && $items->hasDomoprimeProductCalculation())
       {
           if (self::$classic != $items->getDomoprimeCalculation()->get('class_id'))
           {           
              $this->output= format_number($items->getDomoprimeProductCalculation()->get('qmac'),'#0');
           }    
           else
              $this->output=""; 
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
