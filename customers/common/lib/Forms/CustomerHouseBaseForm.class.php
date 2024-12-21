<?php


class CustomerHouseBaseForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'id'=> new mfValidatorInteger(),
            'removal'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),
            'area' => new mfValidatorString(array("min_length"=>0,"max_length"=>20,"required"=>false)), 
            'windows' => new mfValidatorString(array("min_length"=>0,"max_length"=>10,"required"=>false)), 
            'orientation' => new mfValidatorString(array("max_length"=>32,"required"=>false)),                                    
        ));
    }
}

