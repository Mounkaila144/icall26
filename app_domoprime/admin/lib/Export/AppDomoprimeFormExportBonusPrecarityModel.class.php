<?php
// 0 classic 1 modeste ou tres modeste

class AppDomoprimeExportBonusPrecarityModel extends mfExportFormatModelCell {
      
     static protected $classic=null,$intermediate=null;
     
    function __construct() {                               
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
        return __("Bonus precarity",array(),'fields','app_domoprime');
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
           if (!in_array($items->getDomoprimeCalculation()->get('class_id'),[self::$classic,self::$intermediate]))
           {           
              $this->output="1";
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
