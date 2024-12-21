<?php

 require_once dirname(__FILE__)."/CustomerUserForm.class.php";


 class CustomerUserForCompanyNewForm extends CustomerUserForm {
 
     protected $user=null;
     
     function __construct($user,$defaults=array()) {        
        $this->user=$user;
        parent::__construct($defaults);                
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {
        parent::configure();
        unset($this['id']);   
        $this->addValidators(array(
              'password' => new mfValidatorString(),
             'repassword' => new mfValidatorString() 
        ));                
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
    }
    
 
}


