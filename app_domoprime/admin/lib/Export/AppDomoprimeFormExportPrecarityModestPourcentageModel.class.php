<?php

class AppDomoprimeExportPrecarityModestPourcentageModel extends mfExportFormatModelCell {
      
     
    function __toString() {
        return __("Precarity modest %%",array(),'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if ($items->getDomoprimeCalculation()->getClass()->get('name')=='0')
           {           
              $this->output="100%";
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
