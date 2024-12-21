<?php



 class CustomerContractStatusI18nForm extends CustomerContractStatusI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('status_id', new mfValidatorInteger());
    }
    
 
}


