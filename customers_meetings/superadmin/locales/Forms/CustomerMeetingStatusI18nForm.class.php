<?php



 class CustomerMeetingStatusI18nForm extends CustomerMeetingStatusI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('status_id', new mfValidatorInteger());
    }
    
 
}


