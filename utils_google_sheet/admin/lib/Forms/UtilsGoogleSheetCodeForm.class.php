<?php

class UtilsGoogleSheetCodeForm extends mfForm
{
    function __construct($defaults = array()) {
        parent::__construct($defaults);
    }

    function configure() {
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
            "code"=>new mfValidatorString(array('required' => true)),
            "state"=>new mfValidatorString(array('required' => true)),
        ));
    }

}


