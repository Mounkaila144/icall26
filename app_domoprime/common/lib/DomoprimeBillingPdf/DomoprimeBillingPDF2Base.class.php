<?php

class DomoprimeBillingPDF2Base extends wkhtmltopdf {
    
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
    
    function getName()
    {
        return $this->getFile()->getName();
    }
    
    function getFile()
    {
        return new File($this->getFilename());
    }
    
    
    function configure()
    {      
        $this->setOption('filename',$this->getFile());       
        /* $this->setOption('orientation','P');  */        
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
       readfile($this->getTemplateFile());      
    }
        
    
    function save()
    {               
        $this->create();         
      //  parent::save();       
    }
    
    function forceOutput()
    {
        $this->create();       
         mfContext::getInstance()->getResponse()
            ->setHttpHeader('Cache-Control: no-cache, must-revalidate')          
             ->setHeaderFile($this->getFilename(),false)
            ->sendHttpHeaders();
        readfile($this->getFilename());  
        return $this;
    } 
    
    function create()
    {            
         ///$this->setOption("options","--footer-center [page]/[topage] --encoding 'UTF-8' --enable-javascript ")
         $this->setOption("options","--encoding 'UTF-8' --enable-javascript --margin-bottom 0.0 --margin-left 0.0 --margin-right 0.0 --margin-top 0.0")
             ->createPDF('app_domoprime','pdfBilling',array('billing'=>$this->billing,'model'=>$this->model));                          
    }
}

