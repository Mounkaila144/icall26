<?php


class RegistrationFormBase extends mfForm {
    
    
    function __construct($defaults=array(),$site=null) { 
            
        parent::__construct($defaults,array(),$site);
    }
        
    function configure()
    {      
        $this->setValidators(array(     
            "id"=>new mfValidatorInteger(),
            "registration"=>new mfValidatorI18nNumber(),
            "month"=>new mfValidatorInteger(),
            "year"=>new mfValidatorInteger(),
            ) 
        );                      
    }
    
}
