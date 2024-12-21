<?php



 class UserAttributionI18nForm extends UserAttributionI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('attribution_id', new mfValidatorInteger());
    }
    
 
}


