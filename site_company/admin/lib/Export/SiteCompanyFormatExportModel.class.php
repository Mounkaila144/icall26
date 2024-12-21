<?php

class SiteExportFormatExportModel extends CustomerContractFormatExportModel {
    
    protected $helpers=array(); 
    
    function __construct($field,$helpers=null,$title="") {       
        $this->field=$field;
        $this->helpers=$helpers;
        $this->title=$title;       
    }     
    
    function __toString() {
        return (string)$this->title;
    }
    
     function process($items)
     {
        $this->output=SiteCompanyUtils::getSiteCompany()->get($this->field);  
        $this->processHelpers();    
        return $this;
     }
     
    
            
}

