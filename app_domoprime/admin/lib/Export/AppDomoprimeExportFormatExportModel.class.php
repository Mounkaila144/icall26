<?php

class AppDomoprimeExportFormatExportModel extends CustomerContractFormatExportModel  {
    
    protected $title="";
   
    function __construct($class="",$field=null,$helpers=null,$title="") {            
        parent::__construct($class,$field,$helpers);
        $this->title=$title;
    }       
    
     function __toString() {
        return (string)$this->title;
    }
    
            
}
