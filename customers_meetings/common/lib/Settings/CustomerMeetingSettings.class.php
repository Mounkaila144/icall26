<?php

class CustomerMeetingSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                              "status_transfer_to_contract_id"=>null,
                              "status_by_default_id"=>null,
                              "schedule_start_time"=>"6:00", 
                              "schedule_end_time"=>"23:00", 
                              "schedule_scale_time"=>0, 
                              "input_scale_time"=>15,                              
                              "autocomplete_list"=>"YES",
                              "has_assistant"=>"NO",
                              "max_multiple_sms"=>10,
                              "max_multiple_email"=>10,
                              "has_lock_management"=>"NO",
                              "lock_time_out"=>10 * 60, //seconds                             
                              "mobile1_required"=>false,
                              "has_callback"=>"NO",
                              "callback_delay"=>10,   // minute  avant rappel
                              "comment_on_create"=>"NO",
             
             
                              // Internal
                              "callback_time_scheduler"=>60 * 5, // seconds                             
                              "lock_time_scheduler"=>2000, //ms
             
                              "has_callcenter"=>"NO",
                              "has_campaign"=>"NO",
                              "has_type"=>"NO",
                              "has_confirmator"=>"NO",
                              "has_callstatus"=>"NO",
                              "has_qualification"=>"NO",
                              "status_call_by_default_id"=>null,
             
                              "has_lead_status"=>"NO",
                              "filter_schedule_default_status_call_id"=>null,
                              "has_confirmed_at"=>"NO",                             
             
                              "sales_model_email_id"=>null,
                              "sales_model_sms_id"=>null,
                              
                              "has_treated_date"=>"NO",
                              "duplicate_phone_forbidden"=>"NO",
                              "duplicate_phone_forbidden_confirmed"=>"NO",
             
                              "assistant_state1_setting_id"=>null,
                              "assistant_state2_setting_id"=>null,
                              "assistant_state3_setting_id"=>null,
             
                               "telepro_group_id"=>null,
             
                               "has_registration"=>"NO",
                               "registration_number_format"=>"00000000",
                               "registration_number_start"=>260,
                               "registration_format"=>"{year}-{registration}",
                               "registration_class"=>"UtilsRegistration",
                               "registration_method"=>"generateKeyForYear",
                               "updated_at_states"=>array(),
                               "has_polluter"=>"NO",
                               "has_partner_layer"=>"NO",
                               "change_state_sales_model_email_id"=>null,
                               "filter_numberofitems_by_page"=>100,
                               "default_company_id"=>null,
                          ));
        
     }        
     
     function getStatusByDefault()
     {
         return new CustomerMeetingStatus($this->get('status_by_default_id'),$this->getSite());
     }
     
     function getStatusCallByDefaultForScheduleFilter()
     {
         return new CustomerMeetingStatusCall($this->get('filter_schedule_default_status_call_id'),$this->getSite());
     }
     
     function getStatusCallByDefault()
     {
         return new CustomerMeetingStatusCall($this->get('status_call_by_default_id'),$this->getSite());
     }
     
     function hasAssistant()
     {
         return ($this->get('has_assistant')=='YES');
     }
     
     function hasLock()
     {
       return ($this->get('has_lock_management')=='YES');  
     }
     
     function hasCallback()
     {
       return ($this->get('has_callback')=='YES');  
     }
     
     function hasCallcenter()
     {
        return ($this->get('has_callcenter')=='YES');   
     }
     
     function hasCampaign()
     {
        return ($this->get('has_campaign')=='YES');   
     }
     
     function hasType()
     {
         return ($this->get('has_type')=='YES');   
     }
     
  /*    function hasConfirmator()
     {
         return ($this->get('has_confirmator')=='YES');   
     }*/
     
      function hasCallStatus()
     {
         return ($this->get('has_callstatus')=='YES');   
     }
     
      function hasQualification()
     {
         return ($this->get('has_qualification')=='YES');   
     }
       function hasLeadStatus()
     {
         return ($this->get('has_lead_status')=='YES');   
     }
     
     function hasConfirmedAt()
     {
        return ($this->get('has_confirmed_at')=='YES');   
     }
     
      function getSalesModelEmail()
     {
         return new UserModelEmail($this->get('sales_model_email_id'),$this->getSite());
     }
     
      function getSalesModelSms()
     {
         return new UserModelSms($this->get('sales_model_sms_id'),$this->getSite());
     }
     
      function hasTreatedDate()
     {
       return ($this->get('has_treated_date')=='YES');  
     }
     
      function isDuplicatePhoneForbidden()
     {
       return ($this->get('duplicate_phone_forbidden')=='YES');  
     }
    
      function isDuplicatePhoneForbiddenConfirmed()
     {
       return ($this->get('duplicate_phone_forbidden_confirmed')=='YES');  
     }
     
     
      function getStatus1ForAssistant()
     {
         return new CustomerMeetingStatus($this->get('assistant_state1_setting_id'),$this->getSite());
     }
     
       function getStatus2ForAssistant()
     {
         return new CustomerMeetingStatus($this->get('assistant_state2_setting_id'),$this->getSite());
     }
     
       function getStatus3ForAssistant()
     {
         return new CustomerMeetingStatus($this->get('assistant_state3_setting_id'),$this->getSite());
     }
     
     
     function hasGroupForTelepro()
     {
         if ($this->get('telepro_group_id')===null)
             return false;
         $group=new Group($this->get('telepro_group_id'),'admin',$this->getSite());
         return $group->isLoaded();
     }
     
       function getGroupForTelepro()
     {
         return new Group($this->get('telepro_group_id'),'admin',$this->getSite());
     }
     
     function getCallBackTimeScheduler()
     {
         return $this->get('callback_time_scheduler',5) * 1000; // seconds => ms
     }
     
     function hasRegistration()
     {
         return ($this->get('has_registration')=='YES');
     }
     
     function getMethodForRegistration()
     {
         return array($this->get('registration_class'),$this->get('registration_method'));
     }
     
           function hasPolluter()
     {
         return ($this->get('has_polluter')=='YES');
     }
     
            function hasPartnerLayer()
     {
         return ($this->get('has_partner_layer')=='YES');
     }
     
     function hasChangeStateSalesModelEmail()
     {
         return $this->get('change_state_sales_model_email_id');
     }
       function getChangeStateSalesModelEmail()
     {
         return new UserModelEmail($this->get('change_state_sales_model_email_id'),$this->getSite());
     }
     
       function hasDefaultCompany()
     {
         return (boolean)$this->get("default_company_id");
     }
     
     
     function getDefaultCompany()
     {
         return new CustomerContractCompany($this->get("default_company_id"),$this->getSite());
     }
}
