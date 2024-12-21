<?php

class CustomerMeetingFormExportModel extends mfExportFormatModelCell {
    
     protected $title="";
     static $defaults=null;
    
    function __construct($field,$title) {               
        parent::__construct(null, $field);
        $this->title=$title;
        if (self::$defaults===null)      
        {    
           self::$defaults=CustomerMeetingForms::getDefaultValues();          
        }
    }       
    
    function __toString() {
        return (string)$this->title;
    }
    
    function process($items)
    {         
        $schema=explode(".",$this->field);
        if ($items->hasCustomerMeetingForms())
        {                
            $values= $items->getCustomerMeetingForms()->getDataI18nForExport();                         
        }  
        else
        {   
            $values=self::$defaults;           
        }    
         if (isset($values[$schema[0]][$schema[1]]))            
                $this->output= mb_strtoupper($values[$schema[0]][$schema[1]]);               
            else
                $this->output=isset(self::$defaults[$schema[0]][$schema[1]])?self::$defaults[$schema[0]][$schema[1]]:"";
        return $this;
    }
    
    function getClass()
    {
        return "CustomerMeetingForms";
    }
                
}
