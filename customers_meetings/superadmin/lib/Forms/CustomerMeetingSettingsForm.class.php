<?php



 class CustomerMeetingSettingsForm extends CustomerMeetingSettingsBaseForm {
 
    
    function configure()
    {
        parent::configure();
        $this->setValidator("has_assistant",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));   
        $this->setValidator("has_callback",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO"))); 
        $this->setValidator("comment_on_create",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));
        $this->setValidator("has_lock_management",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                       
        $this->setValidator("lock_time_out",new mfValidatorInteger(array('min'=>10,'max'=>1800)));      
        $this->setValidator("callback_time_scheduler",new mfValidatorInteger(array('min'=>60,'max'=>300))); 
        $this->setValidator("has_callcenter",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                       
        $this->setValidator("has_campaign",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                       
        $this->setValidator("has_type",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                       
        $this->setValidator("has_confirmator",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));   
        $this->setValidator("has_callstatus",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));   
        $this->setValidator("has_qualification",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));   
        $this->setValidator("has_lead_status",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));   
        $this->setValidator("has_confirmed_at",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));   
        $this->setValidator("has_treated_date",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO"))); 
        $this->setValidator("has_registration",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO"))); 
        $this->setValidator("registration_format",new mfValidatorString(array())); 
        $this->setValidator("registration_number_start",new mfValidatorInteger(array()));
        $this->setValidator("registration_number_format",new mfValidatorString(array()));     
        $this->setValidator("has_polluter",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                       
        $this->setValidator("filter_numberofitems_by_page",new mfValidatorChoice(array('key'=>true,'choices'=>array('10'=>10,'20'=>20,'50'=>50,'100'=>100))));                     
    }
    
 
}


