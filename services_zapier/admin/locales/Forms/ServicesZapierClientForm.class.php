<?php

class ServicesZapierClientForm extends mfForm {
    function __construct($defaults = array()) {
        parent::__construct($defaults);
    }

    function configure()
    {
        $this->setValidators(array(
            "name"=>new mfValidatorString(array('required' => true,'empty_value' => false)),
            "scope"=>new mfValidatorString(array('required' => false,'empty_value' => false)),
            "redirect_uri"=>new mfValidatorUrl(array('required' => true,'empty_value' => false)),
        ));

    }

}

