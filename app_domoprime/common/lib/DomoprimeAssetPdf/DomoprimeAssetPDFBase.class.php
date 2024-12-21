<?php

class DomoprimeAssetPDFBase extends htmltopdf {
    
    protected $asset=null,$model;
    
    function __construct($model,$asset,$options=array())
    {        
       $this->asset=$asset;
       $this->model=$model;           
       
       parent::__construct($options, null);    
    }
    
    function getFilename()
    {                 
        $value=mfConfig::get('mf_sites_dir')."/".$this->model->getSiteName()."/frontend/data/domoprime/assets/".$this->asset->get('id')."/"."asset_".$this->asset->get('reference')."_".$this->asset->get('id').".pdf";       
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
        $this->setOptions(array(
                         //  "author"=>"administrator",
                         //  "title"=>__("invoice n°%s",$this->orderInvoice->getReference()),
                          // "subject"=>__("invoice"),
                          // "keywords"=>__("products, best")
                          )
                      )
               ->createPDF('app_domoprime','pdfAsset',array('asset'=>$this->asset,'model'=>$this->model));  
    }
}

