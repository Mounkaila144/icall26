<?php

class AppDomoprimeExportFormatExportPrimeOneEuroModel extends AppDomoprimeExportFormatExportModel  {
    
    
    function __construct($class,$title) {                    
        parent::__construct($class);
        $this->title=$title;
    }       
    
    
    
    function processCell($item)
    {    
        $this->output=$item->getPrimeOneEuro();                     
        return $this;
    }   
}
