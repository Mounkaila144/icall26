<?php

class AppDomoprimeExportModestModel extends mfExportFormatModelCell {
    
     protected $title="";
     static protected $classic=null,$intermediate=null;
     
    function __construct($field,$title) {               
        parent::__construct(null, $field);
        $this->title=$title;
        if (self::$classic===null)
        {
            self::$classic= DomoprimeSettings::load()->get('classic_class');
        } 
         if (self::$intermediate===null)
        {
            self::$intermediate= DomoprimeSettings::load()->get('intermediate_class');
        } 
    }       
    
    function __toString() {
        return (string)$this->title;
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())           
       {
           
           if (self::$classic != $items->getDomoprimeCalculation()->get('class_id'))
           {           
              
               if (self::$intermediate == $items->getDomoprimeCalculation()->get('class_id'))
               {
                   $this->output="0"; 
               }
               else
               {    
                 $this->output=$items->getDomoprimeCalculation()->get('qmac');
               }
           }    
           else
              $this->output="0"; 
       } 
       else
       {
           $this->output="0";  
       }    
        return $this;
    }
    
    function getClass()
    {
        return "DomoprimeCalculation";
    }
                
}
