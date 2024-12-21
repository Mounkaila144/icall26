<?php


 class DomoprimeCustomerRequestBaseForm extends mfForm {
 
  
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),  
            'declarants'=>new mfValidatorString(array('required'=>false)),
            'revenue'=>new mfValidatorI18nNumber(array('required'=>true,'empty_value'=>0)),
            'number_of_people'=>new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0)),
            'number_of_children'=>new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0)),
            'surface_wall'=>new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0,'round'=>0)),
            'surface_top'=>new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0,'round'=>0)),
            'surface_floor'=>new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0,'round'=>0)),              
            'number_of_fiscal'=>new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0)),
            'tax_credit_used'=>new mfValidatorI18nNumber(array('required'=>false,'empty_value'=>0)),
            'more_2_years'=>new mfValidatorChoice(array('choices'=>array('YES'=>__("YES"),"NO"=>__("NO")),'key'=>true)),
            ) 
        );
    }
    
 
}


