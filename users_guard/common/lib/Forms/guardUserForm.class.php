<?php

class UserGuardForm extends mfForm {

    function configure() {       
        $this->setValidators(array(
            'username' => new mfValidatorString(),
            'password' => new mfValidatorString(),
            'remember' => new mfValidatorBoolean(),
        ));
        $this->validatorSchema->setPostValidator(new GuardValidatorUser());
    }
}