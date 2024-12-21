<?php

class UserFunctionsImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/users/";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "value"=>new mfValidatorString(array("max_length"=>"255")),
            "lang"=>new mfValidatorString(array("max_length"=>"2")),
            "name"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),           
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getFunctionI18n()
    {                          
        $item= new UserFunctionI18n(array('value'=>(string)$this['value'],'lang'=>(string)$this['lang']),$this->getSite());        
        $item->add($this->getValues());         
        $item->getUserFunction()->set('name',(string)$this['name']);
        if ($item->isNotLoaded())
        {    
            $item->getUserFunction()->save();
            $item->set('function_id',$item->getUserFunction());
        }  
        return $item;
    }
    
    
}
