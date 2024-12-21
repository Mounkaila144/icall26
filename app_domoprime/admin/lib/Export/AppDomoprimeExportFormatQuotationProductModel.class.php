<?php

class AppDomoprimeExportFormatQuotationProductModel extends mfExportFormatModelCell {
    
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
        
       if ($items->hasDomoprimeQuotationProduct() )       
       {
            //  die(__METHOD__);
            $this->output=$items->getDomoprimeQuotationProduct()->get($this->field);                                 
       }
        else $this->output="";
        return $this;
    }
    
    function getClass()
    {
        return "DomoprimeQuotationProduct";
    }
                
}
