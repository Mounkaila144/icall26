<?php

require_once dirname(__FILE__)."/../Validators/CustomerUserForgotPasswordValidator.class.php";

class CustomerUserForgotPasswordForm extends mfForm {

    function configure() {       
        $this->setValidators(array(
            'email' => new mfValidatorEmail() //array(),array("required"=>__("This field is required"))),
        ));        
       $this->validatorSchema->setPostValidator(new CustomerUserForgotPasswordValidator());
    }
}