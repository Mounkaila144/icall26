<?php


 class SiteTextBaseForm extends mfForm {
 
  
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),            
         //   'module'=>new mfValidatorString(array()),
         //   'key'=>new mfValidatorString(array()),
            'value'=>new mfValidatorString()
            ) 
        );
    }
    
 
}


