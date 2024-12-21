<?php

class PartnersImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/partners";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "name"=>new mfValidatorString(array("max_length"=>"255")),
         
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getPartners()
    {                          
        $item= new Partner(array('name'=>(string)$this['name']),$this->getSite());        
        $item->add($this->getValues());
        return $item;
    }
    
    
    
    
}
