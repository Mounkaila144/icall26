<?php

 class CustomerMeetingFormBaseForm extends mfForm {
 
   // All fields excepted foreign keys
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "name"=>new mfValidatorNameForForm(array("max_length"=>64)),               
            ) 
        );
    }
    
 
}


