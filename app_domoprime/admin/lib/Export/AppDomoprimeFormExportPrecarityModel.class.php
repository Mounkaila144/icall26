<?php

class AppDomoprimeExportPrecarityModel extends mfExportFormatModelCell {
      
     static protected $classic=null;
     
    function __construct() {                               
        if (self::$classic===null)
        {
            self::$classic= DomoprimeSettings::load()->get('classic_class');
        }    
    }       
    
    function __toString() {
        return __("Precarity",array(),'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if (self::$classic != $items->getDomoprimeCalculation()->get('class_id'))
           {           
              $this->output="0";
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
        return "DomoprimeCalculation";
    }
                
}
