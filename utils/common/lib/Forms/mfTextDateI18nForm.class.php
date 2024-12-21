<?php

class mfTextDateI18nForm extends mfForm{
    
    function configure()
    {
        $this->setOption("disabledCSRF",true);
        $this->setValidators(array(
            "dates" => new mfValidatorSchemaForEach(new mfValidatorI18nDate(array("date_format"=>"a"),array('bad_format'=>"[{value}]")),count($this->getDefault("dates"))),
        ));
    }
    
}

