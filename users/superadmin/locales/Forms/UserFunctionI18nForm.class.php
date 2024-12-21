<?php



 class UserFunctionI18nForm extends UserFunctionI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('function_id', new mfValidatorInteger());
    }
    
 
}


