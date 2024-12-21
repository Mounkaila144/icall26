<?php

class AppDomoprimeExportVeryModestModel extends mfExportFormatModelCell {
    
     protected $title="";
  
     
    function __construct() {               
        parent::__construct();
        $this->title=__("Global Cumac value for very modest",array(),'fields','app_domoprime');
         
    }       
    
    function __toString() {
        return (string)$this->title;
    }
    
    function process($items)
    {              
        if ($items->hasDomoprimeCalculation() && $items->hasDomoprimeClass())           
       {
           
           if ($items->getDomoprimeClass()->get('name')==1)
           {                     
               $this->output=$items->getDomoprimeCalculation()->get('qmac');           
           }    
           else
              $this->output="0"; 
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
