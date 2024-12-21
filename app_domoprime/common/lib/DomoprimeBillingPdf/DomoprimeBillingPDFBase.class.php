<?php

class DomoprimeBillingPDFBase extends htmltopdf {
    
    protected $billing=null,$model;
    
    function __construct($model,DomoprimeBilling $billing,$options=array())
    {        
       $this->billing=$billing;
       $this->model=$model;           
       
       parent::__construct($options, null);    
    }
    
    function getFilename()
    {                 
         return $this->billing->getFilenameForPdf();
    }
    
    function getFile()
    {
        return new File($this->getFilename());
    }
    
    
    function configure()
    {      
        $this->setOption('filename',$this->getFilename());       
        $this->setOption('orientation','P');          
        parent::configure();
    }
    
 
    
   function output()
    {       
       $this->debug();        
       $this->create();            
       parent::output();
    }
        
    
    function save()
    {               
        $this->create();         
        parent::save();
    }
    
    function forceOutput()
    {
        $this->create();       
        parent::save();
        parent::_output(); 
    }
    
    function create()
    {      
        $this->setOptions(array(
                         //  "author"=>"administrator",
                         //  "title"=>__("invoice n°%s",$this->orderInvoice->getReference()),
                          // "subject"=>__("invoice"),
                          // "keywords"=>__("products, best")
                          )
                      )
               ->createPDF('app_domoprime','pdfBilling',array('billing'=>$this->billing,'model'=>$this->model));  
    }
}

