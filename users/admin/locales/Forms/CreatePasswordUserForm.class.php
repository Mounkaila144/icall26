<?php

class CreatePasswordUserForm extends mfForm {
    
    
     function configure() {   
        $settings=new UserSettings();
        $this->setValidators(array(
             'id'=>new mfValidatorInteger(),
             'password' => new mfValidatorSecurePassword($settings->getOptionsForValidator()),
            'repassword' => new mfValidatorString(),
        ));
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
    }
}