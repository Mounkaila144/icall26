<?php

class themeNewForm extends mfForm {

    function configure() { 
        $this->setValidators(array(
            'name'=>new mfValidatorName(),
            'zip'=>new mfValidatorZipFile(array('max_size'=>500000)))
                );
    }
    
}