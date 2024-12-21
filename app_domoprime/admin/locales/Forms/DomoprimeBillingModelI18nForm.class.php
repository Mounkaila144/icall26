<?php



 class DomoprimeBillingModelI18nForm extends DomoprimeBillingModelI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('model_id', new mfValidatorInteger());
    }
    
 
}


