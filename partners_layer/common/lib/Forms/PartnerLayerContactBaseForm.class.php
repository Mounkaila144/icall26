<?php


class PartnerLayerContactBaseForm extends mfFormSite {
    
                
    function configure() {                   
        $this->setValidators(array(
            'id' => new mfValidatorInteger(),              
            'sex'=>new mfValidatorChoice(array("choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true)),
            'firstname'=> new mfValidatorName(),
            'lastname'=> new mfValidatorName(),
            'email'=> new mfValidatorEmail(array("required"=>false)), 
            'fax'=> new mfValidatorI18nPhone(array("culture"=>$this->getDefault('country'),"required"=>false)),
            'phone' => new mfValidatorI18nPhone(array("culture"=>$this->getDefault('country'),"required"=>false)),
            'mobile'=> new mfValidatorI18nMobile(array("culture"=>$this->getDefault('country'),"required"=>false)),
                                       
        ));                                  
    }
    

    
}


