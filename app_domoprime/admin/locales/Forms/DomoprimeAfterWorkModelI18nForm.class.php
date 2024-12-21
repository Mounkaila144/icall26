<?php



 class DomoprimeAfterWorkModelI18nForm extends DomoprimeAfterWorkModelI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('model_id', new mfValidatorInteger());
    }
    
 
}


