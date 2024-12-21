<?php

class siteChangeAccessForm extends mfForm {
    
     function configure() {       
        $this->setValidators(array(
            'host' => new mfValidatorDomain(), 
            'access_restricted' => new mfValidatorBoolean()
        ));
    }
}