<?php

class CustomerMeetingImportForm extends mfForm {
    
    protected $path=null;
    
    function __construct($path) {
        $this->path=$path;
        parent::__construct(array(),array());
    }
    
    function getPathSourceForFiles()
    {
       return $this->path."/meetings/imports";
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            "phone"=>new mfValidatorString(array("max_length"=>"10")),
          //  "lang"=>new mfValidatorString(array("max_length"=>"2","min_length"=>"2")),           
          //  "name"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
          //  "color"=>new mfValidatorString(array("max_length"=>"10","required"=>false)),
          //  "icon"=>new mfValidatorFileForImport(array("max_size"=>200000,"required"=>false,"mime_types"=>"web_images","path"=>$this->getPathSourceForFiles())),
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
   /* function getStatusI18n()
    {                          
        $item= new CustomerMeetingStatusI18n(array('lang'=>(string)$this['lang'],'value'=>(string)$this['value']),$this->getSite());        
        $item->add($this->getValues());
        $item->getCustomerMeetingStatus()->set('color',(string)$this['color']);
        return $item;
    }*/
    
    
    
    
}
