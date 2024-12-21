<?php
// 0 classic 1 modeste ou tres modeste

class AppDomoprimeExportTypeGridPrecarityModel extends mfExportFormatModelCell {
      
        
    
    function __toString() {
        return __("Type Grille Precarité A ou B",array(),'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if ($items->getDomoprimeCalculation()->getClass()->get('name')=="1")                   
           {           
              $this->output=__("prime + surprime grille A");
           }    
           elseif ($items->getDomoprimeCalculation()->getClass()->get('name')=="0")           
           {    
              $this->output=__("prime B"); 
           }
           else
           {
              $this->output=__("prime");  
           }    
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

