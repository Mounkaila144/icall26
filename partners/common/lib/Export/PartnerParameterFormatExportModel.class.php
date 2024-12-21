<?php


class PartnerParameterFormatExportModel extends CustomerContractFormatExportModel {
    
    protected $name="";
    
    function __construct($field,$helpers=array()) {      
        $this->name=$field;
        parent::__construct('Partner','parameters',$helpers);      
    }             
    
    function getName()
    {
        return $this->name;
    }
    
    function processCell($item)
    {                      
        
        $this->output = $item->getParameters()->get($this->getName());
     
        // helpers
        
        
        
       
       return $this;
    }
     
    
}

