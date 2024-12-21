<?php

// 'sale_price','purchasing_price',
    
class ProductItemBaseForm extends mfFormSite {
    
   
    protected $user=null;
    
    function __construct($defaults = array(),$user=null,$site=null) {
        $this->user=$user;
        parent::__construct($defaults, array(), $site);
    }
   
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {              
       $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                                                                                                                               
            "reference"=>new mfValidatorString(array("max_length"=>"255")),      
            "input1"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),      
            "input2"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),  
            "input3"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),  
            "description"=>new mfValidatorString(array("max_length"=>"32768","required"=>false)),
            "content"=>new mfValidatorString(array("max_length"=>"32768","required"=>false)),            
            "details"=>new mfValidatorString(array("max_length"=>"32768","required"=>false)),       
            "thickness"=>new mfValidatorI18nNumber(array("required"=>false)),     
            "mark"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),     
           "layer_process"=>new mfValidatorString(array("max_length"=>"32","required"=>false)),  
           "input4"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),
           "input5"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),
           "input6"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),
           "input7"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),
       ));                                          
    }
    
}


