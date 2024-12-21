<?php



 class CustomerMeetingSettingsForm extends CustomerMeetingSettingsBaseForm {
 
    
    function configure()
    {
        parent::configure();
        $settings=CustomerMeetingSettings::load();                          
        if ($settings->hasRegistration())
        {    
          $this->setValidator("registration_number_start",new mfValidatorInteger(array()));
          $this->setValidator("registration_number_format",new mfValidatorString(array())); 
          $this->setValidator("registration_format",new mfValidatorString(array())); 
        }
    }
}


