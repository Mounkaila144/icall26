<?php

class AppDomoprimeCustomerRequestExportModel extends CustomerContractFormatExportModel  {
    
    protected $title="",$name=null;
   
    function __construct($name,$title="") {       
        $this->name=$name;    
        $this->title=$title;
    }       
    
     function __toString() {
        return (string)$this->title;
    }
    function process($items)
    {                      
       if ($items->hasDomoprimeCustomerRequest())
       {
          $this->output=$this->title." ".$items->getDomoprimeCustomerRequest()->get($this->name);         
       }         
        return $this;
    }
    
    function getClass()
    {
        return "DomoprimeCustomerRequest";
    }
            
}
