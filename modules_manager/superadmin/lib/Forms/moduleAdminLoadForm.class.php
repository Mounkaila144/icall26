<?php

class moduleAdminLoadForm extends mfForm {

    function configure() { 
        $this->setValidators(array(
            'file'=>new mfValidatorZipFile(array('max_size'=>500000)))
                );
    }
    
}
