<?php

class AppDomoprimeExportModel extends mfExportFormatModelCell {
    
     protected $title="";     
     
    function __construct($field,$title) {               
        parent::__construct(null, $field);
        $this->title=$title;        
    }       
    
    function __toString() {
        return (string)$this->title;
    }
    
    function process($items)
    {              
       if ($items->hasDomoprimeCalculation())
       {
         /*  if (self::$classic==$items->getDomoprimeCalculation()->get('class_id'))
           {
               $this->output="CLASSIC";
           }    
           else
           {
               $this->output="MODESTE";
           }   */ 
       }    
      // echo "<pre>"; var_dump($items); echo "</pre>";
       /* if ($items->hasCustomerMeetingForms())
        {    
            $schema=explode(".",$this->field);
            $values=$items->getCustomerMeetingForms()->getDataI18n();
            if (isset($values[$schema[0]][$schema[1]]))            
                $this->output= mb_strtoupper($values[$schema[0]][$schema[1]]);               
            else
                $this->output="";
        }*/
        return $this;
    }
    
    function getClass()
    {
        return "DomoprimeCalculation";
    }
                
}
