<?php

class ContractStatusImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/contracts";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "value"=>new mfValidatorString(array("max_length"=>"255")),
            "lang"=>new mfValidatorString(array("max_length"=>"2","min_length"=>"2")),           
            "name"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "color"=>new mfValidatorString(array("max_length"=>"10","required"=>false)),
            "icon"=>new mfValidatorFileForImport(array("max_size"=>200000,"required"=>false,"mime_types"=>"web_images","path"=>$this->getPathSourceForFiles())),
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getStatusI18n()
    {                          
        $item= new CustomerContractStatusI18n(array('lang'=>(string)$this['lang'],'value'=>(string)$this['value']),$this->getSite());        
        $item->add($this->getValues());
        $item->getCustomerContractStatus()->add(array('color'=>(string)$this['color'],'name'=>(string)$this['name']));
        return $item;
    }
    
    
    
    
}
