<?php

class groupBaseForm extends mfForm {

    function configure() {       
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(),
            'name' => new mfValidatorName(), // @TODO define min max + messages
        ));
    }
}