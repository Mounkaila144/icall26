<?php

class ProductsImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/products";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "meta_title"=>new mfValidatorString(array("max_length"=>"255")),
            "reference"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),           
            "meta_description"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "price"=>new mfValidatorI18nCurrency(array("required"=>false,'currency'=>ProductSettings::load($this->getSite())->get('default_currency','EUR'))), 
            "content"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),   
            "tva"=>new mfValidatorI18nPourcentage(array("required"=>false)),
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getProduct()
    {                          
        $item= new Product(array('meta_title'=>(string)$this['meta_title']),$this->getSite());        
        $item->add($this->getValues());
        return $item;
    }
    
    function getTax()
    {
        $item=new Tax(array('rate'=>(string)$this['tva']),$this->getSite());
        if ($item->isNotLoaded())
        {    
            $item->set('description',(string)$this['tva'] * 100 ."%");
            $item->save();
        }    
        return $item;
    }
    
    
}
