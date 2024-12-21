<?php



 class CustomerContractRangeI18nForm extends CustomerContractRangeI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('range_id', new mfValidatorInteger());
    }
    
 
}


