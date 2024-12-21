<?php



 class CustomerMeetingRangeI18nForm extends CustomerMeetingRangeI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('range_id', new mfValidatorInteger());
    }
    
 
}


