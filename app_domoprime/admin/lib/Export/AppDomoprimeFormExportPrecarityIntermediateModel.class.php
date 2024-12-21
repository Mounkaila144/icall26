<?php

class AppDomoprimeExportPrecarityIntermediateModel extends mfExportFormatModelCell {
           
    static protected $classic=null;
      
    function __construct() {                                      
        if (self::$classic===null)
        {
            self::$classic= DomoprimeSettings::load()->get('classic_class');
        }    
    }       
    
    function __toString() {
        return __("Precarity Intermediate",array(),'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if ($items->getDomoprimeCalculation()->getClass()->get('name')==3 || static::$classic == $items->getDomoprimeCalculation()->get('class_id'))
           {           
              $this->output="0";
           }    
           else
              $this->output="1"; 
       } 
        else
       {
           $this->output="";  
       }
        return $this;
    }
    
    function getClass()
    {
        return "DomoprimeCalculation";
    }
                
}
