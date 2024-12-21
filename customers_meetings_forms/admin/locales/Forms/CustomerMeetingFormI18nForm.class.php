<?php



 class CustomerMeetingFormI18nForm extends CustomerMeetingFormI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('form_id', new mfValidatorInteger());
    }
    
 
}


