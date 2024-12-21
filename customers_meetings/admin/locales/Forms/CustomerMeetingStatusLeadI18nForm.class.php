<?php



 class CustomerMeetingStatusLeadI18nForm extends CustomerMeetingStatusLeadI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('status_id', new mfValidatorInteger());
    }
    
 
}


