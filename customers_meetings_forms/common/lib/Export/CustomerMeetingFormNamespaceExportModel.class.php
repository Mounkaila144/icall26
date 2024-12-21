<?php

class CustomerMeetingFormNamespaceExportModel extends CustomerMeetingFormExportModel {
    
    protected $ns=null;
    
    function __construct($ns,$field,$title) {
        $this->ns=$ns;
        parent::__construct( $field,$title);
   
    }       
    
    
    
    function process($items)
    {             
        if ($items->hasCustomerMeetingForms())
        {   // ===FRED===               
            $schema=explode(".",$this->field);
            $values=$items->getCustomerMeetingForms()->getDataI18nForExport();                     
           if (isset($values[$schema[0]][$schema[1]]))            
                $this->output= mb_strtoupper($values[$schema[0]][$schema[1]]);               
            else
                $this->output=""; 
        }        
        return $this;
    }
    
    
                
}
