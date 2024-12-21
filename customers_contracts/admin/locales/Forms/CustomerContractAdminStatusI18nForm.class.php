<?php



 class CustomerContractAdminStatusI18nForm extends CustomerContractAdminStatusI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('status_id', new mfValidatorInteger());
    }
    
 
}


