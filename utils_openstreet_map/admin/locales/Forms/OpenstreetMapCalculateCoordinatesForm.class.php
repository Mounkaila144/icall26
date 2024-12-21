<?php

class OpenstreetMapCalculateCoordinatesForm extends mfForm {

    function __construct($defaults = array()) {
        parent::__construct($defaults);
    }

    function configure() {
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
             'address'=>new mfValidatorString(array('required'=>true)),
        ));
    }
    
    
}
