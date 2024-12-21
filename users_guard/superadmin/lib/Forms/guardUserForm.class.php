<?php

class userGuardForm extends mfForm {

    function configure() {       
        $this->setValidators(array(
            'username' => new mfValidatorString(array(),array("required"=>__("This field is required."))),
            'password' => new mfValidatorString(array(),array("required"=>__("This field is required."))),
            'remember' => new mfValidatorBoolean(),
        ));
        $this->validatorSchema->setPostValidator(new guardValidatorUser());
    }
}