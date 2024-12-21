<?php



 class PartnerPolluterModelI18nForm extends PartnerPolluterModelI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('model_id', new mfValidatorInteger());
    }
    
 
}


