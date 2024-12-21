<?php


class PartnerContactBaseForm extends mfFormSite {
    
                
    function configure() {                   
        $this->setValidators(array(
            'id' => new mfValidatorInteger(),              
            'sex'=>new mfValidatorChoice(array("choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true)),
            'firstname'=> new mfValidatorName(),
            'lastname'=> new mfValidatorName(),
            'email'=> new mfValidatorEmail(array("required"=>false)), 
            'fax'=> new mfValidatorString(array("required"=>false)),
            'phone' => new mfValidatorString(array("required"=>false)),
            'mobile'=> new mfValidatorString(array("required"=>false)),
                                       
        ));                                  
    }
    

    
}


