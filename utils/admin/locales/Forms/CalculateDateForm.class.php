<?php


class CalculateDateForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            "date" => new mfValidatorI18nDate(array("date_format"=>"a","empty_value"=>date("Y-m-d"),"required"=>false)), //new mfValidatorSchemaForEach(new mfValidatorI18nDate(array("date_format"=>"a")),count($this->getDefault('holidays'))),
        ));
    }
}
