<?php

class DomoprimePartnerPolluterDocumentPdfBase extends html3pdf {
    
    protected $document=null,$contract=null,$site=null;
    
    function __construct(CustomerContract $contract,PartnerPolluterDocument $document,$options=array())
    {        
       $this->document=$document;
       $this->contract=$contract;
       $this->site=$contract->getSite();
       parent::__construct($options, null);    
    }
    
    function getPath()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->contract->getSiteName()."/frontend/data/contracts/".$this->contract->get('id');
    }
    
    
    function getSite()
    {
        return $this->site;
    }
    
    function getFilename()
    {
        
        return $this->getPath()."/".$this->document->getNameWithExtension();
    }
    
     function getFile()
    {
        return new File($this->getFilename());
    }
    
    
    function getDocument()
    {
        return $this->document;
    }
    
    
    function getContract()
    {
        return $this->contract;
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
               ->createPDF('customers_meetings_forms_documents','pdf',array('document'=>$this->document,'contract'=>$this->contract));  
    }
}

