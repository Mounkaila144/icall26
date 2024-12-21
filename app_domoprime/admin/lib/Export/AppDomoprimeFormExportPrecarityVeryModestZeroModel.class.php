<?php

class AppDomoprimeExportPrecarityVeryModestZeroModel extends mfExportFormatModelCell {
      
          
    
    function __toString() {
        return __("Precarity very modest",array(),'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if ($items->getDomoprimeCalculation()->getClass()->get('name')=='1')
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
