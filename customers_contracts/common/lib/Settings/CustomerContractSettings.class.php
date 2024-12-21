<?php

class CustomerContractSettings extends mfSettingsBase {
    
     protected static $instance=null;
     protected $default_attribution=null;    
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                              "default_status_id"=>null,
                              "default_attribution_id"=>null,
                              "default_currency"=>"EUR",
                              "tax_amount_display"=>"NO",
                              "tax_amount_display_list"=>"NO",
                              "autocomplete_list"=>"YES",
                              "ttc_change_by_tax"=>"YES",
                              // Comments
                              "comment_sale1"=>"NO",
                              "comment_sale2"=>"NO",
                              "comment_creation"=>"NO",
                              "comment_delete"=>"NO",
                              "comment_install_status"=>"NO",
                              "comment_opc_status"=>"NO",
                              "comment_time_state"=>"NO",
             
                              "has_assistant"=>"NO",
                              "format_id"=>"000000",
                              
                              "number_of_day_for_opc"=>1,
             
             
                              "has_polluter"=>"NO",
             
                              "change_state_email_model_id"=>null,
             
                              "hold_statuses"=>array(),
             
                              "status_if_confirmed_id"=>null,             
                              "status_if_unconfirmed_id"=>null,
             
                              "status_for_cancel_id"=>null,
                              "status_for_uncancel_id"=>null,
             
                              "status_for_blowing_id"=>null,
                              "status_for_unblowing_id"=>null,
             
                              "status_for_placement_id"=>null,
                              "status_for_unplacement_id"=>null,
             
                              "has_partner_layer"=>'NO',
                              "change_state_sales_model_email_id"=>null,
             
                              "number_of_attributions"=>500,
                           /*   "default_status_for_1_billing"=>null,
                              "default_status_for_2_billings"=>null,
                              "default_status_for_3_billings"=>null,
                              "default_model_email_for_1_billing"=>null,
                              "default_model_email_for_2_billings"=>null,
                              "default_model_email_for_3_billings"=>null,*/
                           // "default_status_for_billable_contract"=>null,
                            "default_status1_for_no_billable_contract"=>null,
                            "default_status2_for_no_billable_contract"=>null,
                            "filter_numberofitems_by_page"=>100, 
                           "default_company_id"=>null,
                          ));
        
     }    
     
     function getDefaultUserAttribution()
     {
         if (!$this->default_attribution)
         {
         //    var_dump($this->getSite());
         // var_dump($this->get('default_attribution_id'));
            $this->default_attribution=new UserAttribution($this->get('default_attribution_id'),$this->getSite());
            $this->default_attribution->getUserAttributionI18n();
         }    
         return $this->default_attribution;
     }
     
        function hasAssistant()
     {
         return ($this->get('has_assistant')=='YES');
     }
     
          function hasPolluter()
     {
         return ($this->get('has_polluter')=='YES');
     }
     
      function getChangeStateModelEmail()
     {
         return new UserModelEmail($this->get('change_state_email_model_id'),$this->getSite());
     }
     
     function getHoldStatuses()
     {
         return (array)$this->get('hold_statuses');
     }
     
     function hasConfirmedStatus()
     {
         return $this->get('status_if_confirmed_id');
     }
     
     function hasUnConfirmedStatus()
     {
         return $this->get('status_if_unconfirmed_id');
     }
     
      function hasCancelStatus()
     {
         return $this->get('status_for_cancel_id');
     }
     
       function hasUnCancelStatus()
     {
         return $this->get('status_for_uncancel_id');
     }
     
     function hasBlowingStatus()
     {
         return $this->get('status_for_blowing_id');
     }
     
       function hasUnBlowingStatus()
     {
         return $this->get('status_for_unblowing_id');
     }
     
     function hasPlacementStatus()
     {
         return $this->get('status_for_placement_id');
     }
     
       function hasUnPlacementStatus()
     {
         return $this->get('status_for_unplacement_id');
     }
     
     function hasLayer() 
     {
         return $this->get('has_partner_layer')=='YES';
     }
     
     function hasChangeStateSalesModelEmail()
     {     
         return $this->get('change_state_sales_model_email_id');
     }
       function getChangeStateSalesModelEmail()
     {
         return new UserModelEmail($this->get('change_state_sales_model_email_id'),$this->getSite());
     }
     
     
   /*   function getModelForOneBilling(){
         return new CustomerContractBillingRevivalEmailModel($this->get('default_model_email_for_1_billing'), $this->getSite());
     }
     function getModelForTwoBilling(){
         return new CustomerContractBillingRevivalEmailModel($this->get('default_model_email_for_2_billings'), $this->getSite());
     }
    function getModelForTreeBilling(){
         return new CustomerContractBillingRevivalEmailModel($this->get('default_model_email_for_3_billings'), $this->getSite());
     }*/
     
     function getStatus1NoBillable(){
         return new CustomerContractStatus($this->get('default_status1_for_no_billable_contract'),$this->getSite());
     }
     function getStatus2NoBillable(){
         return new CustomerContractStatus($this->get('default_status2_for_no_billable_contract'),$this->getSite());
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
