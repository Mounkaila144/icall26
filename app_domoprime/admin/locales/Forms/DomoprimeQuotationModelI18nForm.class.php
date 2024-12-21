<?php



 class DomoprimeQuotationModelI18nForm extends DomoprimeQuotationModelI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('model_id', new mfValidatorInteger());
    }
    
 
}


