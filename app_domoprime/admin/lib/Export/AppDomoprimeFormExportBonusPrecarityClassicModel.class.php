<?php

class AppDomoprimeExportBonusPrecarityClassicModel extends mfExportFormatModelCell {
      
     static protected $classic=null;
     
    function __construct() {                               
        if (self::$classic===null)
        {
            self::$classic= DomoprimeSettings::load()->get('classic_class');
        }    
    }       
    
    function __toString() {
        return __("Bonus precarity 2",array(),'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if (self::$classic == $items->getDomoprimeCalculation()->get('class_id'))                           
              $this->output="";                     
           elseif ($items->getDomoprimeCalculation()->getClass()->get('name')=='0')
              $this->output="0";  // Modest
           elseif ($items->getDomoprimeCalculation()->getClass()->get('name')=='3') 
              $this->output=""; // intermediate 
           else
              $this->output="1"; // tres  Modest  
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
