<?php

class AppDomoprimeExportPrecarityClassicModel extends mfExportFormatModelCell {
      
     
    static protected $classic=null,$intermediate=null;
    
    protected $value=""; 
    
    function __construct($value="1") {                               
        $this->value=$value;
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
        return __("Precarity classic [%s]",$this->value,'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if (in_array($items->getDomoprimeCalculation()->get('class_id'),[self::$classic,self::$intermediate]))
           {           
              $this->output="";
           }    
           else
           {    
              $this->output=$this->value; 
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
