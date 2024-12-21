<?php



 class CustomerContractOpcStatusI18nForm extends CustomerContractOpcStatusI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('status_id', new mfValidatorInteger());
    }
    
 
}


