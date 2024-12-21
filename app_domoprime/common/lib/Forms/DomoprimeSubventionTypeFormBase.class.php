<?php


 class DomoprimeSubventionTypeBaseForm extends mfForm {
 
  
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),            
            'name'=>new mfValidatorString(array()),
            'commercial'=>new mfValidatorString(array('required'=>false))
            ) 
        );
    }
    
 
}


