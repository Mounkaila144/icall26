<?php


 class DomoprimeClassBaseForm extends mfForm {
 
   // All fields excepted foreign keys
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "name"=>new mfValidatorString(array("required"=>false,"max_length"=>64)),   
            "coef"=>new mfValidatorI18nNumber(),      
            "color"=>new mfValidatorString(array("required"=>false,"max_length"=>16)),    
            "multiple"=>new mfValidatorI18nNumber(),    
            "multiple_floor"=>new mfValidatorI18nNumber(array('required'=>false,'max'=>'3','min'=>0)),    
            "multiple_top"=>new mfValidatorI18nNumber(array('required'=>false,'max'=>'3','min'=>0)),    
            "multiple_wall"=>new mfValidatorI18nNumber(array('required'=>false,'max'=>'3','min'=>0)),    
            'prime'=>new mfValidatorI18nNumber(array('required'=>false)),    
            'pack_prime'=>new mfValidatorI18nNumber(array('required'=>false)), 
            "subvention"=>new mfValidatorI18nNumber(array('required'=>false)),  
            "bbc_subvention"=>new mfValidatorI18nNumber(array('required'=>false)),  
            "coef_prime"=>new mfValidatorI18nPourcentage(array('required'=>false)),  
            ) 
        );
    }
    
 
}


