<?php

class languageNewForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'code' => new mfValidatorString(array('max_length'=>"2","min_length"=>2)), // @TODO define min max + messages           
        ));
    }
}