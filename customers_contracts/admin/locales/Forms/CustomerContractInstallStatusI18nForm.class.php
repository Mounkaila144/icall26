<?php



 class CustomerContractInstallStatusI18nForm extends CustomerContractInstallStatusI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('status_id', new mfValidatorInteger());
    }
    
 
}


