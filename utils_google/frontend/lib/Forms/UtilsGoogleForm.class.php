<?php

class UtilsGoogleForm extends mfForm
{
    function __construct($defaults = array()) {
        parent::__construct($defaults);
    }

    function configure() {
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
            "state"=>new mfValidatorString(array('required' => true)),
            "code"=>new mfValidatorString(array('required' => true)),
            "scope"=>new mfValidatorString(array('required' => true)),
        ));
    }

}


