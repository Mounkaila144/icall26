<?php

class CreatePasswordUserForm extends mfForm {
    
    
     function configure() {     
        $this->setValidators(array(
             'id'=>new mfValidatorInteger(),
            'password' => new mfValidatorString(),
            'repassword' => new mfValidatorString(),
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
    }
}