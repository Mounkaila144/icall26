<?php

class AppDomoprimeExportMethodFormatExportModel extends CustomerContractFormatExportModel  {
    
    protected $title="" ;
   
    function __construct($class="",$method=null,$helpers=null,$title="") {       
        parent::__construct($class,$method,$helpers);
        $this->title=$title;
        $this->method=$method;
    }       
    
    function getMethod()
    {
        return $this->field;
    }
    
     function __toString() {
        return (string)$this->title;
    }
          
     function processCell($item)
    {                     
       if (!method_exists($item->getFormatter(), $this->getMethod()))
            return $this;
       $method=$this->getMethod();
       $this->output=$item->getFormatter()->$method();                 
        return $this;
    }
}
