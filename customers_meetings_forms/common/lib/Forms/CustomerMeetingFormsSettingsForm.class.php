<?php



 class CustomerMeetingFormsSettingsForm extends mfFormSite {
 
    function __construct($site) {       
        parent::__construct(array(),array(),$site);
    }
  
    function configure()
    {
        $this->setValidators(array(            
                'fields_feature'=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            ) 
        );                      
    }
    
 
}


