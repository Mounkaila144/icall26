<?php

class CityForm extends mfForm {

    function configure() {       
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
             'postcode' => new mfValidatorString(),  
             'country' => new mfValidatorI18nChoiceCountry(),
        ));        
    }
}

