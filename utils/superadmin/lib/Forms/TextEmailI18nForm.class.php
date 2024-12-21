<?php

class TextEmailI18nForm extends mfForm {

    function configure()
    {
        $this->setValidators(array(
            "lang"=>new mfValidatorString(array("min_length"=>2,"max_length"=>2)),
            "key"=>new mfValidatorString(),
            "subject"=>new mfValidatorString(),
            "body"=>new mfValidatorString(),
            "module"=>new mfValidatorString()
        ));
    }
}