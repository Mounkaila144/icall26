<?php


class CustomerFinancialBaseForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'id'=> new mfValidatorInteger(),
            'credit_used'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),
            'inprogress_credit'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),
            'credit_amount' => new mfValidatorString(array("required"=>false)),            
            'credit_date' => new mfValidatorString(array("required"=>false)),            
        ));
    }
}

 