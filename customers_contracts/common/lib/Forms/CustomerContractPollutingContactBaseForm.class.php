<?php


class CustomerContractPollutingContactBaseForm extends mfForm{
    
        function configure(){                   
        $this->setValidators(array(
            'id' => new mfValidatorInteger(),              
            'sex'=>new mfValidatorChoice(array("choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true)),
            'firstname'=> new mfValidatorName(),
            'lastname'=> new mfValidatorName(),
            'email'=> new mfValidatorEmail(array("required"=>false)), 
            'fax'=> new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
            'function'=> new mfValidatorString(array("required"=>false)),
            'phone' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
            'mobile'=> new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),                                    
        ));                                  
    }
}
