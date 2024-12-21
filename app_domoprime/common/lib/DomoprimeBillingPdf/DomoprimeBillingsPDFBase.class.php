<?php

class DomoprimeBillingsPDFBase  extends htmltopdf {
    
    protected $billings=null,$model=null;
    
    function __construct($billings,$model,$options=array())
    {        
       $this->billings=$billings;
       $this->model=$model;                  
       parent::__construct($options, null);    
    }
    
    function getBillings()
    {
        return $this->billings;
    }
    
    function getModel()
    {
        return $this->model;
    }
    
    function getName()
    {
        return __('billings')."_".$this->getBillings()->getSignature().".pdf";       
    }
    
    static function getDirectory($site=null)
    {
        $path=$site?$site->getSiteName():mfContext::getInstance()->getSite()->getSiteName();
        return mfConfig::get('mf_sites_dir')."/".$path."/frontend/data/domoprime/billings";
    }
    
    function getFilename()
    {                 
        $value=mfConfig::get('mf_sites_dir')."/".$this->getModel()->getSiteName()."/frontend/data/domoprime/billings/".$this->getName();
        return $value;
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
       mfFileSystem::mkdirs(self::getDirectory());
       // var_dump($this->billings);
       $this->setOptions(array(
                         //  "author"=>"administrator",
                         //  "title"=>__("invoice n°%s",$this->orderInvoice->getReference()),
                          // "subject"=>__("invoice"),
                          // "keywords"=>__("products, best")
                          )
                      )
               ->createPDF('app_domoprime','pdfBillings',array('billings'=>$this->billings,'model'=>$this->getModel()));  
    }
    
    function getUrl()
    {
        return url_to('app_domoprime_billings_file',array('file'=>$this->getName()));
    }
    
    static function getFile($file,$site=null)
    {
        return new File(self::getDirectory($site)."/".$file);
    }
}