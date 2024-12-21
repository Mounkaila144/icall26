<?php

class TextI18nForm extends mfForm {

    function configure()
    {
        $this->setValidators(array(
            "lang"=>new mfValidatorString(array("min_length"=>2,"max_length"=>2)),
            "key"=>new mfValidatorString(),
            "text"=>new mfValidatorString()
        ));
    }
}