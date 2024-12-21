<?php



 class CustomerMeetingSettingsBaseForm extends mfFormSite {
     
     protected $user=null;
     
    function __construct($user,$site=null) {       
        $this->user=$user;
        parent::__construct(array(),array(),$site);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {
        $settings=CustomerMeetingSettings::load($this->getSite());
        $this->setValidators(array(            
            "status_transfer_to_contract_id"=> new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),            
          /*  "schedule_start_time"=>"6:00", 
            "schedule_end_time"=>"23:00", 
            "schedule_scale_time"=>0, 
            "input_scale_time"=>15,*/
            "callback_delay"=>new mfValidatorInteger(array('min'=>10,'max'=>60*3)),
            "max_multiple_sms"=>new mfValidatorInteger(array('min'=>1)),
            "max_multiple_email"=>new mfValidatorInteger(array('min'=>1)),
            "status_by_default_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),            
            "status_call_by_default_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerMeetingStatusCall::getStatusForI18nSelect($this->getSite()))),            
            "autocomplete_list"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "mobile1_required"=>new mfValidatorBoolean(array("empty_value"=>false)),            
            "product_by_default"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+ProductUtils::getProductsForSelect($this->getSite()))),            
            "filter_schedule_default_status_call_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerMeetingStatusCall::getStatusForI18nSelect($this->getSite()))),            
            "sales_model_sms_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+UserModelSmsBaseUtils::getModelI18nSmsForSelect($this->getSite()))),            
            "sales_model_email_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+UserModelEmailBaseUtils::getModelI18nEmailForSelect($this->getSite()))),            
            "duplicate_phone_forbidden"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "duplicate_phone_forbidden_confirmed"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "assistant_state1_setting_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),   
            "assistant_state2_setting_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),   
            "assistant_state3_setting_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),   
            "updated_at_states"=>new mfValidatorChoice(array("key"=>true,"required"=>false,'multiple'=>true,"choices"=>array(""=>"")+CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),   
            "has_partner_layer"=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
            "change_state_sales_model_email_id"=>new mfValidatorChoice(array("key"=>true,"required"=>false,"choices"=>array(""=>"")+UserModelEmailBaseUtils::getModelI18nEmailForSelect($this->getSite()))),            
            "default_company_id"=> new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>CustomerContractCompany::getCompaniesForSelect($this->getSite())->unshift(array(""=>"")))),            
            ) 
        );                       
        if ($settings->hasRegistration())
        {    
          $this->setValidator("registration_number_start",new mfValidatorInteger(array()));
          $this->setValidator("registration_number_format",new mfValidatorString(array()));                  
        }
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_meeting_settings_default_company'))))
           $this->setValidator("default_company_id",new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>CustomerContractCompany::getCompaniesForSelect($this->getSite())->unshift(array(""=>"")))));
    }
    
    
    function getDefaultProduct()
    {
        return new Product($this->get('product_by_default'),$this->getSite());
    }
 
}


