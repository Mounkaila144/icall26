<?php



 class CustomerMeetingImportSettingsBaseForm extends mfFormSite {
 
    function __construct($site=null) {       
        parent::__construct(array(),array(),$site);
    }
  
    function configure()
    {
        $this->setValidators(array(            
           // "status_transfer_to_contract_id"=> new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),            
          /*  "schedule_start_time"=>"6:00", 
            "schedule_end_time"=>"23:00", 
            "schedule_scale_time"=>0, 
            "input_scale_time"=>15,
            "callback_delay"=>new mfValidatorInteger(array('min'=>10,'max'=>60*3)),
            "max_multiple_sms"=>new mfValidatorInteger(array('min'=>1)),
            "max_multiple_email"=>new mfValidatorInteger(array('min'=>1)),
            "status_by_default_id"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "autocomplete_list"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "mobile1_required"=>new mfValidatorBoolean(array("empty_value"=>false)),            
            "product_by_default"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+ProductUtils::getProductsForSelect($this->getSite()))),             */
            ) 
        );                      
    }
    
    
   
 
}


