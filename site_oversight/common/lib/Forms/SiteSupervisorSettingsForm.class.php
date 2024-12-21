<?php


class SiteOversightSettingsForm extends mfForm {
   
    
    function configure() {
        $this->setValidators(array(
            'emails'=>new mfValidatorMultiple(new mfValidatorEmail(),array('required'=>false)),
            'oversights'=>new mfValidatorMultiple(new mfValidatorEmail()),
        ));
    }
}
