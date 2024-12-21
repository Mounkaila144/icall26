<?php


class CustomerMeetingViewForm extends mfForm {
         
    protected $user=null,$settings=null,$_meeting=null;
    
    function __construct($user,CustomerMeeting $meeting,$defaults = array(), $options = array()) {
        $this->user=$user;
        $this->_meeting=$meeting;
        $this->settings= new CustomerMeetingSettings();
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getMeeting()
    {
       return $this->_meeting;    
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function configure()
    {                
        $this->setValidator('id',new mfValidatorInteger());
        $this->embedForm('meeting', new CustomerMeetingBaseForm($this->getDefault('meeting'),array()));          
       if (!$this->getUser()->hasGroups('telepro') || $this->getUser()->hasGroups('commercial') || $this->getUser()->hasCredential(array(array('meeting_modify_sales'))))
       {                    
           $this->meeting->addValidators(array(               
                 'sales_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))),
                 'telepro_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No teleprospector")+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('TELEPRO',$this->getUser()))),                 
                 'sale2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))),
                ));
       }     
       if ($this->getMeeting()->isUnHold())
       {    
            $this->embedForm('customer', new CustomerBaseForm($this->getDefault('customer')));    
            $this->embedForm('address', new CustomerAddressBaseForm($this->getDefault('address')));   
            $this->embedForm('contact', new CustomerContactBaseForm($this->getDefault('contact'))); 
            $this->defaults['address']['country']='FR';
            foreach ($this->contact->getSchema() as $validator)
            {
                $validator->setOption('required',false);
            }
       }
  //     $this->embedForm('house', new CustomerHouseBaseForm($this->getDefault('house'))); 
  //     $this->embedForm('financial', new CustomerFinancialBaseForm($this->getDefault('financial'))); 
  //     $this->customer->addValidator('union_id',new mfValidatorChoice(array('key'=>true,'choices'=>CustomerUnionUtils::getUnionForI18nSelect())));
       unset($this->meeting['customer_id'],$this->meeting['id'],
              $this->customer['id'],$this->address['id'],$this->house['id'],
              $this->contact['id'],$this->address['country'],$this->financial['id']
             );
       // Settings            
       if ($this->getUser()->hasCredential(array(array('superadmin','admin'))))
           $this->meeting['telepro_id']->setOption('required',false);    
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_state'))))
          $this->meeting->addValidator('state_id',new mfValidatorChoice(array('key'=>true,'choices'=>CustomerMeetingStatusUtils::getStatusForI18nSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_created_date','meeting_view_created_date'))))
          $this->meeting->addValidator('created_at',new mfValidatorI18nDate(array('date_format'=>'a','with_time'=>true)));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_assistant'))) && $this->getSettings()->hasAssistant())
           $this->meeting->addValidator('assistant_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No assistant"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('ASSISTANT',$this->getUser()))));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_callback','meeting_modify_callback'))) && $this->getSettings()->hasCallback())       
           $this->meeting->addValidator('callback_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>10,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));       
       if ($this->getSettings()->get('mobile1_required'))
           $this->customer['mobile']->setOption('required',true);
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_campaign'))) && $this->getSettings()->hasCampaign())
           $this->meeting->addValidator('campaign_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No campaign"))+CustomerMeetingUtils::getCampaignForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_callcenter'))) && $this->getSettings()->hasCallcenter())
           $this->meeting->addValidator('callcenter_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No callcenter"))+Callcenter::getCallcenterForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_modify_type'))) && $this->getSettings()->hasType())
           $this->meeting->addValidator('type_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No type"))+CustomerMeetingType::getTypeI18nForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_qualified'))) && $this->getSettings()->hasQualification())
           $this->meeting->addValidator('is_qualified',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_callstatus'))) && $this->getSettings()->hasCallStatus())
           $this->meeting->addValidator('status_call_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No status"))+CustomerMeetingStatusCall::getStatusForI18nSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_lead_status'))) && $this->getSettings()->hasLeadStatus())
           $this->meeting->addValidator('status_lead_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No status"))+CustomerMeetingStatusLead::getStatusForI18nSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_treatment_date'))))
          $this->meeting->addValidator('treated_at',new mfValidatorI18nDate(array('date_format'=>'a','required'=>false)));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_createdby'))))
           $this->meeting->addValidator('created_by_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No user"))+UserUtils::getUsersForSelect())));
       // Remove
       if ($this->getUser()->hasGroups('assistant') || $this->getUser()->hasCredential(array(array('meeting_view_assistant_as_user'))) && $this->getSettings()->hasAssistant())
             unset($this->meeting['assistant_id']);
       if (!$this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_sale_comments'))))
             unset($this->meeting['sale_comments']);  
       if ($this->getUser()->hasCredential(array(array('meeting_view_telepro_as_user','meeting_view_no_telepro'))))
          unset($this->meeting['telepro_id']); 
       if ($this->getUser()->hasCredential(array(array('meeting_view_no_sale1'))))
          unset($this->meeting['sales_id']); 
       if ($this->getUser()->hasCredential(array(array('meeting_view_no_sale2'))))
          unset($this->meeting['sale2_id']); 
       if ($this->getUser()->hasCredential(array(array('meeting_view_telepro_select','meeting_modify_telepro'))))   
       {               
          $telepros=new mfArray(UserFunctionUtils::getUsersByFunctionForSelect2ForUser('TELEPRO',$this->getUser()));
          if (!$this->getUser()->hasCredential(array(array('meeting_view_telepro_not_empty'))))                   
              $telepros->unshift(array("0"=>__("No teleprospector")));          
          $this->meeting->addValidator('telepro_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>$telepros->toArray())));       
        //   $this->meeting->addValidator('telepro_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"No teleprospector")+UserFunctionUtils::getUsersByFunctionForSelectForUser('TELEPRO',$this->getUser()))));       
       }
       if ($this->getUser()->hasCredential(array(array('meeting_view_sale1_select')))) 
          $this->meeting->addValidator('sales_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
       if ($this->getUser()->hasCredential(array(array('meeting_view_sale2_select'))))    
          $this->meeting->addValidator('sale2_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('superadmin','meeting_modify_company'))))    
          $this->customer->addValidator('company',new mfValidatorString(array("required"=>false)));    
       if ($this->getUser()->hasCredential(array(array('meeting_view_date_rdv_minimum'))) && $this->meeting->hasValidator('in_at'))    
          $this->meeting['in_at']->setOption('min',date("Y-m-d")." 00:00:00");  
       if ($this->getUser()->hasCredential(array(array('meeting_modify_turnover'))))
           $this->meeting->addValidator('turnover',new mfValidatorI18nCurrency(array('currency'=>ProductSettings::load()->get('default_currency','EUR'))));     
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('meeting_phone_string','meeting_view_phone_string'))))        
           $this->customer->addValidator('phone',new mfValidatorString(array()));         
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('meeting_mobile1_string','meeting_view_mobile1_string'))))
           $this->customer->addValidator('mobile',new mfValidatorString(array()));   
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('meeting_mobile2_string','meeting_view_mobile2_string'))))
           $this->customer->addValidator('mobile2',new mfValidatorString(array())); 
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('meeting_modify_birthday_required'))))      
            $this->customer->addValidator('birthday',new mfValidatorI18nDate(array('date_format'=>'a'))); 
       if ($this->hasValidator('address') && $this->getUser()->hasCredential(array(array('meeting_postcode_not_required'))))
           $this->address['postcode']->setOption('required',false);   
       if ($this->getUser()->hasCredential(array(array('meeting_view_no_remarks'))))
           unset($this->meeting['remarks']); 
       if ($this->hasValidator('address') && $this->getUser()->hasCredential(array(array('meeting_view_no_address2'))))
           unset($this->address['address2']);     
       if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_polluter'))))                   
           $this->meeting->addValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>$this->getUser()->hasCredential(array(array('contract_meeting_polluter_not_empty_value')))?PartnerPolluterCompany::getPollutersForSelect2():PartnerPolluterCompany::getPollutersForSelect2()->unshift(array(""=>__("Not defined"))))));                
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_opc_at'))))         
          $this->meeting->addValidator('opc_at',new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)));              
       if ($this->getUser()->hasCredential(array(array('meeting_modify_opc_at_datetime'))))            
          $this->meeting->addValidator('opc_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));       
        if ($this->meeting->hasValidator('opc_at') && $this->getUser()->hasCredential(array(array('meeting_opc_at_required'))))              
          $this->meeting->opc_at->setOption('required',true);      
       if ($this->getUser()->hasCredential(array(array('meeting_modify_postcode_string_integer_validator'))))   
          $this->address->addValidator('postcode',new mfValidatorIntegerString(array("min_length"=>5,"max_length"=>5)));      
       if ($this->getUser()->hasCredential(array(array('meeting_view_remove_in_at'))))
           unset($this->meeting['in_at']); 
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_opc_range'))))      
            $this->meeting->addValidator('opc_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));       
        if ($this->getDefault('meeting') && $this->getUser()->hasCredential(array(array('meeting_modify_opc_at_and_range_required_if_transfert_state'))) && $this->meeting->hasValidators(array('opc_at','opc_range_id','state_id')))   
        {
            if ($this->getSettings()->get('status_transfer_to_contract_id') == $this->defaults['meeting']['state_id'])
            {
                $this->meeting['opc_at']->setOption('required',true);
                $this->meeting['opc_range_id']->setOption('required',true);
            }    
        } 
        if ($this->getSettings()->hasPartnerLayer() && $this->getUser()->hasCredential(array(array('superadmin','meeting_modify_partner_layer'))))                           
            $this->meeting->addValidator('partner_layer_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerLayerCompany::getLayersForSelect())));                                         
       if ($this->getUser()->hasCredential(array(array('meeting_modify_in_at_range','meeting_view_in_at_and_sav_at_to_contract_opc_at_opened_to'))))      
       {
            $this->meeting->addValidator('in_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));  
            $this->meeting->addValidator('in_at_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));       
       }
       if ($this->getUser()->hasCredential(array(array('meeting_view_lastname_not_required'))) && $this->hasValidator('customer'))      
            $this->customer['lastname']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_view_firstname_not_required'))) && $this->hasValidator('customer'))      
            $this->customer['firstname']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_view_phone_not_required'))) && $this->hasValidator('customer'))      
            $this->customer['phone']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_view_postcode_not_required'))) && $this->hasValidator('address'))      
            $this->address['postcode']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_view_address1_not_required'))) && $this->hasValidator('address'))      
            $this->address['address1']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_view_city_not_required')))  && $this->hasValidator('address'))      
            $this->address['city']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_modify_meeting_company'))))            
            $this->meeting->setValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));                
        $this->validatorSchema->setPostValidator(new mfValidatorCallbacks(new mfArray(array(array($this, 'check')))));        
    }
    
    
    
    function getDefaultValuesForMeeting()
    {
        $values=array();
        $state=new CustomerMeetingStatus('WAITING');
        $values['state_id']=$state->get('id');                               
        return $values;                
    }
    
    function getCustomerValues()
    {
        if ($this->hasValidator('customer'))
            return $this['customer']->getValue();
        return array();
    }
    
    function getAddressValues()
    {
        if ($this->hasValidator('address'))
            return $this['address']->getValue();
        return array();
    }
    
     function getContactValues()
    {
        if ($this->hasValidator('contact'))
            return $this['contact']->getValue();
        return array();
    }
    
    function hasPolluter()
    {        
        if (!$this->getDefault('meeting') || $this->meeting->hasValidator('polluter_id'))
            return $this->getMeeting()->hasPolluter();          
        return $this->isReady()?(boolean)$this['meeting']['polluter_id']->getValue():(boolean)$this->defaults['meeting']['polluter_id'];    
    }
    
  /*  function getPolluter()
    {
        if (!$this->getDefault('meeting') || $this->meeting->hasValidator('polluter_id'))
            return $this->getMeeting()->getPolluter();   
        return new PartnerPolluterCompany($this->isReady()?(boolean)$this['meeting']['polluter_id']->getValue():(boolean)$this->defaults['meeting']['polluter_id']);       
    } */
    
    function check($validator,$values)
    {        
        if ($this->hasErrors())
            return $values;   
       /* echo "+++";
         $errors_schema=array();
         $errors_schema['opc_at']=new mfValidatorError($this->meeting['opc_at'],__("Opc date has to be "));       
         throw new mfValidatorErrorSchema($validator,array('meeting'=>new mfValidatorErrorSchema($this->meeting,$errors_schema)));*/
        return $values;
    }
}

