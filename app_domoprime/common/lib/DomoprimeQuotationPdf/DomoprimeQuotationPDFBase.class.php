<?php

class DomoprimeQuotationPDFBase extends html3pdf {
    
    protected $quotation=null,$model;
    
    function __construct($model,DomoprimeQuotation $quotation,$options=array())
    {        
       $this->quotation=$quotation;
       $this->model=$model;           
       
       parent::__construct($options, null);    
    }
    
    function getFilename()
    {                         
        return $this->quotation->getFilenameForPdf();
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
    
    function isReadable()
    {
        return is_readable($this->getFilename());
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
               ->createPDF('app_domoprime','pdf',array('quotation'=>$this->quotation,'model'=>$this->model));                          
    }
}

