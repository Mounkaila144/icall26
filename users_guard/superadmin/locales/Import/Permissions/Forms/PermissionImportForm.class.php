<?php

class PermissionImportForm extends mfFormSite {
    
    protected $path=null;
    
    function __construct($path,$site = null) {
        $this->path=$path;
        parent::__construct(array(),array(), $site);
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/users";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "name"=>new mfValidatorString(array("max_length"=>"255")),
            "group"=>new mfValidatorString(array("max_length"=>"30","required"=>false)),
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getPermission()
    {                          
        $item= new Permission((string)$this['name'],'admin',$this->getSite());        
        $item->add($this->getValues());        
        return $item;
    }
    
    function getPermissionGroup()
    {
        return new PermissionGroup($this['group']->getValue(),$this->getSite());
    }
}
