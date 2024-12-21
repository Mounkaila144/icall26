<?php



 class DomoprimePolluterClassBaseForm extends mfForm {
 

    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
             "coef"=>new mfValidatorI18nNumber(),               
          //  "multiple"=>new mfValidatorI18nNumber(),     
            "multiple_floor"=>new mfValidatorI18nNumber(array('required'=>false)),    
            "multiple_top"=>new mfValidatorI18nNumber(array('required'=>false)),    
            "multiple_wall"=>new mfValidatorI18nNumber(array('required'=>false)),    
         //  'prime'=>new mfValidatorI18nNumber(array('required'=>false)),    
          //  'pack_prime'=>new mfValidatorI18nNumber(array('required'=>false)),    
          //  'ite_prime'=>new mfValidatorI18nNumber(array('required'=>false)),    
          //  'ana_prime'=>new mfValidatorI18nNumber(array('required'=>false)),    
            ) 
        );
    }
    
 
}


