<?php

class AppDomoprimeCustomerMeetingFormsExportModel extends CustomerContractFormatExportModel  {
    
    protected $title="",$ns=null,$name=null;
   
    function __construct($ns,$name,$title="") {       
        $this->name=$name;
        $this->ns=$ns;
        $this->title=$title;
    }       
    
     function __toString() {
        return (string)$this->title;
    }
    function process($items)
    {                      
       if ($items->hasCustomerMeetingForms())
       {   
          $this->output=$this->title." ".$items->getCustomerMeetingForms()->getDataFromFieldname($this->ns,$this->name);
       }         
        return $this;
    }
    
    function getClass()
    {
        return "CustomerMeetingForms";
    }
            
}
