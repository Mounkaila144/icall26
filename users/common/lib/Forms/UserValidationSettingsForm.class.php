<?php



 class UserValidationSettingsForm extends mfForm {
 
   
  
    function configure()
    {
        $this->setValidators(array(            
            "email"=> new mfValidatorEmail(),           
            ));            
    }
    
 
}


