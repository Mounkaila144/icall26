<?php


require_once __DIR__."/DasboardMultipleChangePasswordUserSitesForm.class.php";

class DasboardMultipleChangePasswordUserForm extends DasboardMultipleChangePasswordUserSitesForm {

    
    
   
    
    function configure() {              
         parent::configure();
          $this->addValidators(array(
                    'login'=>new mfValidatorString(array()),
                    'password'=>new mfValidatorString(array()),
                    'repassword'=>new mfValidatorString(array())
              ));
         $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));  
        
    }
          
    
    
 
}