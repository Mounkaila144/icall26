<?php


class CustomerContactBaseForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'id'=> new mfValidatorInteger(),
            'gender'=>new mfValidatorChoice(array("choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true)),
            'firstname' => new mfValidatorName(), 
            'lastname' => new mfValidatorName(), 
            'email' => new mfValidatorEmail(),                        
            'salary'=> new mfValidatorString(array('required'=>false)),
            'occupation'=> new mfValidatorString(array('required'=>false)),
            'age'=>new mfValidatorString(array('required'=>false)),
            'phone'=>new mfValidatorI18nPhone(),
            'mobile'=>new  mfValidatorI18nMobile(array('required'=>false)),
        ));
    }
    
 
}

