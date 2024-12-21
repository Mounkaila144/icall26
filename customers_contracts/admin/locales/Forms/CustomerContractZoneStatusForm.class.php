<?php


class CustomerContractZoneStatusForm extends mfForm{
    
    function configure() {
        
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(),
            'value' => new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array('YES'=>'YES',"NO"=>"NO"))),            
        ));
    }
    
}
