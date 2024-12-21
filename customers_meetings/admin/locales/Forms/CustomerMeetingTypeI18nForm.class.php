<?php



 class CustomerMeetingTypeI18nForm extends CustomerMeetingTypeI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('type_id', new mfValidatorInteger());
    }
    
 
}


