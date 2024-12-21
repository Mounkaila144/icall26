<?php

class AppDomoprimeExportFormatExportOneEuroModel extends AppDomoprimeExportFormatExportModel  {
    
    
    function __construct($class,$title) {                    
        parent::__construct($class);
        $this->title=$title;
    }       
    
    
    function processCell($item)
    {    
        $this->output=1.0;                     
        return $this;
    }   
}
