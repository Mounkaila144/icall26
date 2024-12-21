<?php

class PermissionBaseForm extends mfFormSite {

    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
    
    function configure() {       
        $this->setValidators(array(
          //  'id' => new mfValidatorInteger(), 
            'name' => new mfValidatorName(), // @TODO define min max + messages
        ));
    }
}