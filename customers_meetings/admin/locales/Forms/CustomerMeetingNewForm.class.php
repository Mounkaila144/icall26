<?php

require_once dirname(__FILE__)."/CustomerNewForm.class.php";
require_once dirname(__FILE__)."/ProductsMultipleNewForm.class.php";

class MeetingDateTimeForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'date'=>new mfValidatorDate(array("date_format"=>"~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2}) (?P<hour>\d{2}):(?P<minute>\d{2})~","with_time"=>true))
            ));
    }
       
}

class CustomerMeetingNewForm extends mfForm {
         
    protected $user=null,$settings=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        $this->settings= CustomerMeetingSettings::load();
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function configure()
    {                   
       $this->embedForm('meeting', new CustomerMeetingBaseForm($this->getDefault('meeting'),array()));             
       if (!$this->getUser()->hasGroups('telepro') || $this->getUser()->hasGroups('commercial'))
       {
           $this->meeting->addValidators(array(
                 // 'state_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>CustomerMeetingStatusUtils::getStatusForI18nSelect())),
                 'sales_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser()))),
                 'telepro_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No teleprospector")+UserFunctionUtils::getUsersByFunctionForSelectForUser('TELEPRO',$this->getUser()))),                 
                 'sale2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser()))),
                ));
       }     
       $this->embedForm('customer', new CustomerNewForm($this->getDefault('customer')));  
       $this->customer->setMessage('field_missing', __('This field is missing.'));
       $this->embedForm('address', new CustomerAddressBaseForm($this->getDefault('address')));   
       $this->embedForm('contact', new CustomerContactBaseForm($this->getDefault('contact'))); 
        if (!$this->getUser()->hasCredential(array(array('meeting_new_remove_products'))))  	   
        {            
             $has_products=(boolean)$this->getDefault('products');                
             $this->embedForm('products', new ProductsMultipleNewForm($this->getDefault('products')));               
             if (!$has_products)       
                    $this->products->setOption('required',false);                               
        } 
       unset($this->meeting['id'],$this->meeting['customer_id'],
              $this->customer['id'],$this->address['id'],$this->house['id'],
              $this->contact['id'],$this->address['country'],$this->financial['id']
             );
       foreach ($this->contact->getSchema() as $validator)
       {           
           $validator->setOption('required',false);
       }
       if ($this->getUser()->hasCredential(array(array('meeting_new_remove_in_at'))))    
          unset($this->meeting['in_at']);        
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_state','meeting_new_state'))))
          $this->meeting->addValidator('state_id',new mfValidatorChoice(array('key'=>true,'choices'=>CustomerMeetingStatusUtils::getStatusForI18nSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_created_date','meeting_new_created_date'))))         
          $this->meeting->addValidator('created_at',new mfValidatorI18nDate(array('date_format'=>'a')));          
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_assistant','meeting_new_assistant'))) && $this->getSettings()->hasAssistant())
           $this->meeting->addValidator('assistant_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No assistant"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('ASSISTANT',$this->getUser()))));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_callback','meeting_new_callback'))) && $this->getSettings()->hasCallback())       
           $this->meeting->addValidator('callback_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>5,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));       
       if ($this->getSettings()->get('mobile1_required'))
           $this->customer['mobile']->setOption('required',true);
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_campaign','meeting_new_campaign'))) && $this->getSettings()->hasCampaign())
           $this->meeting->addValidator('campaign_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No campaign"))+CustomerMeetingUtils::getCampaignForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_callcenter','meeting_new_callcenter'))) && $this->getSettings()->hasCallcenter())
           $this->meeting->addValidator('callcenter_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No callcenter"))+Callcenter::getCallcenterForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_modify_type','meeting_new_type'))) && $this->getSettings()->hasType())
           $this->meeting->addValidator('type_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No type"))+CustomerMeetingType::getTypeI18nForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_qualified','meeting_new_qualified'))) && $this->getSettings()->hasQualification())
           $this->meeting->addValidator('is_qualified',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_callstatus','meeting_new_callstatus'))) && $this->getSettings()->hasCallStatus())
           $this->meeting->addValidator('status_call_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No status"))+CustomerMeetingStatusCall::getStatusForI18nSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_lead_status','meeting_new_lead_status'))) && $this->getSettings()->hasLeadStatus())
           $this->meeting->addValidator('status_lead_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No status"))+CustomerMeetingStatusLead::getStatusForI18nSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_modify_treatment_date','meeting_new_treated_at'))))
          $this->meeting->addValidator('treated_at',new mfValidatorI18nDate(array('date_format'=>'a','required'=>false)));                   
       if ($this->getUser()->hasCredential(array(array('meeting_new_assistant_as_user'))))
          unset($this->meeting['assistant_id']);
       if ($this->getUser()->hasCredential(array(array('meeting_new_telepro_select'))))   
       {     
          $telepros=new mfArray(UserFunctionUtils::getUsersByFunctionForSelectForUser('TELEPRO',$this->getUser()));
          if (!$this->getUser()->hasCredential(array(array('meeting_new_telepro_not_empty'))))         
              $telepros->unshift(array("0"=>__("No teleprospector")));           
          $this->meeting->addValidator('telepro_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>$telepros->toArray())));     
         //   $this->meeting->addValidator('telepro_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>"No teleprospector")+UserFunctionUtils::getUsersByFunctionForSelectForUser('TELEPRO',$this->getUser()))));     
       }       
       if ($this->getUser()->hasCredential(array(array('superadmin','admin'))))
            $this->meeting['telepro_id']->setOption('required',false);     
       if ($this->getUser()->hasCredential(array(array('meeting_new_telepro_as_user','meeting_new_no_telepro'))))
          unset($this->meeting['telepro_id']);
       if ($this->getUser()->hasCredential(array(array('meeting_new_sale1_select')))) 
          $this->meeting->addValidator('sales_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser()))));
       if ($this->getUser()->hasCredential(array(array('meeting_new_sale2_select'))))    
          $this->meeting->addValidator('sale2_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser()))));
       if ($this->getUser()->hasCredential(array(array('meeting_new_sale1_remove')))) 
          unset($this->meeting['sales_id']);
         if ($this->getUser()->hasCredential(array(array('meeting_new_sale2_remove')))) 
          unset($this->meeting['sale2_id']);
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_new_company'))))    
          $this->customer->addValidator('company',new mfValidatorString(array("required"=>false)));   
       if ($this->getUser()->hasCredential(array(array('meeting_new_date_rdv_minimum'))) && $this->meeting->hasValidator('in_at'))    
          $this->meeting['in_at']->setOption('min',date("Y-m-d")." 00:00:00");  
       if ($this->getUser()->hasCredential(array(array('meeting_new_turnover'))))
           $this->meeting->addValidator('turnover',new mfValidatorI18nCurrency(array('currency'=>ProductSettings::load()->get('default_currency','EUR')))); 
       if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','meeting_new_polluter'))))                           
           $this->meeting->addValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>$this->getUser()->hasCredential(array(array('contract_meeting_polluter_not_empty_value')))?PartnerPolluterCompany::getPollutersForSelect()->toArray():PartnerPolluterCompany::getPollutersForSelect()->unshift(array(""=>__("Not defined")))->toArray())));                           
       if ($this->getUser()->hasCredential(array(array('meeting_new_opc_at_datetime'))))         
          $this->meeting->addValidator('opc_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));                    
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_new_opc_at'))))         
          $this->meeting->addValidator('opc_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));                    
       if ($this->getUser()->hasCredential(array(array('meeting_new_postcode_string_integer_validator'))))   
          $this->address->addValidator('postcode',new mfValidatorIntegerString(array("min_length"=>5,"max_length"=>5)));  
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_new_opc_range'))))      
            $this->meeting->addValidator('opc_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));                    
       if ($this->getUser()->hasCredential(array(array('meeting_new_birthday_required'))))      
            $this->customer->addValidator('birthday',new mfValidatorI18nDate(array('date_format'=>'a')));  
       if ($this->getDefault('meeting') && $this->getUser()->hasCredential(array(array('meeting_new_opc_at_and_range_required_if_transfert_state'))) && $this->meeting->hasValidators(array('opc_at','opc_range_id','state_id')))   
       {
            if ($this->getSettings()->get('status_transfer_to_contract_id') == $this->defaults['meeting']['state_id'])
            {
                $this->meeting['opc_at']->setOption('required',true);
                $this->meeting['opc_range_id']->setOption('required',true);
            }    
       } 
       if ($this->getSettings()->hasPartnerLayer() && $this->getUser()->hasCredential(array(array('superadmin','meeting_new_partner_layer'))))
       {                          
            $this->meeting->addValidator('partner_layer_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerLayerCompany::getLayersForSelect())));                                      
       } 
       if ($this->getUser()->hasCredential(array(array('meeting_modify_in_at_range','meeting_view_in_at_and_opc_at_to_contract_sav_at_opened_to'))))      
       {
            $this->meeting->addValidator('in_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));   
            $this->meeting->addValidator('in_at_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));       
       }
       if ($this->getUser()->hasCredential(array(array('meeting_new_lastname_not_required'))))      
            $this->customer['lastname']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_new_firstname_not_required'))))      
            $this->customer['firstname']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_new_phone_not_required'))))      
            $this->customer['phone']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_new_postcode_not_required'))))      
            $this->address['postcode']->setOption('required',false);
         if ($this->getUser()->hasCredential(array(array('meeting_new_city_not_required'))))      
            $this->address['city']->setOption('required',false);
       if ($this->getUser()->hasCredential(array(array('meeting_new_address1_not_required'))))      
            $this->address['address1']->setOption('required',false);
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('meeting_new_phone_string'))))        
           $this->customer->addValidator('phone',new mfValidatorString(array()));         
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('meeting_new_mobile1_string'))))
           $this->customer->addValidator('mobile',new mfValidatorString(array()));   
       if ($this->hasValidator('customer') && $this->getUser()->hasCredential(array(array('meeting_new_mobile2_string'))))
           $this->customer->addValidator('mobile2',new mfValidatorString(array())); 
        if ($this->getUser()->hasCredential(array(array('superadmin','meeting_new_meeting_company'))))                    
           $this->meeting->addValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerMeetingCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));                 
       $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'check'))));
    }  
    
    function getDefaultValuesForMeeting()
    {   
        $values=array();               
        $values['state_id']=$this->getSettings()->getStatusByDefault()->get('id');
        $values['status_call_id']=$this->getSettings()->getStatusCallByDefault()->get('id');
        if (isset($this->defaults['meeting']['in_at']['date']))
            $values['in_at']=$this->defaults['meeting']['in_at']['date'];
        if ($this->meeting->hasValidator('created_at') && !isset($this->defaults['meeting']['created_at']))        
            $values['created_at']=date("Y-m-d");        
        if ($this->getUser()->hasCredential(array(array('meeting_new_default_in_at_now'))))
            $values['in_at']=date("Y-m-d H:i:s");    
        if ($this->getUser()->hasCredential(array(array('meeting_new_default_treated_at_now'))))
            $values['treated_at']=date("Y-m-d H:i:s");   
        if ($this->getUser()->hasCredential(array(array('meeting_new_default_treated_at_null'))))
            $values['treated_at']=null;                 
        if (!isset($this->defaults['meeting']['company_id']))                                             
            $this->defaults['meeting']['company_id']=$this->getSettings()->get('default_company_id');                              
        return $values;                
    }     
    
    function setDefaultDateTime($datetime)
    {             
        $this->defaults['meeting']['in_at']=array('date'=>date("Y-m-d",  strtotime($datetime)),
                                                   'hour'=>date("H",  strtotime($datetime)),
                                                   'minute'=>date("i",  strtotime($datetime)),
                                                  );
    }
    
    
    function getProducts()
    {               
        if (!$this->getDefault('products') && $this->isValid())
        {                       
                return ProductSettings::load()->getDefaultProducts();                      
        }        
        return $this['products']['collection']->getValues();                
    }
    
    
    function check($validator,$values)
    {
        if ($this->hasErrors())
            return $values;        
        return $values;
    }
    
    
    function getMeetingValues()
    {
        $values=parent::getValue('meeting');
        if (!$values['telepro_id'] &&  $this->getUser()->hasCredential(array(array('meeting_new_telepro_creator_default'))))
        {                    
           if (!$this->getUser()->getGuardUser()->getTeleproCollaborators()->isEmpty())
              $values['telepro_id'] = $this->getUser()->getGuardUser()->getTeleproCollaborators()->getFirst();
        }
        return $values;
    }
    
     function hasPolluter()
    {                     
        return $this->isReady()?(boolean)$this['meeting']['polluter_id']->getValue():(boolean)$this->defaults['meeting']['polluter_id'];    
    }
    
    
     function getMeeting()
    {
        if ($this->_meeting===null)
        {            
            if ($this->hasValidator('id'))
            {                             
                 $this->_meeting=$this->isValid()?$this['id']->getValue():new CustomerMeeting($this->getDefault('id'));  
            }   
            else
            {    
                $this->_meeting=new CustomerMeeting();  
                $this->_meeting->add($this->getDefaultValuesForMeeting());       
            }
        }   
        return $this->_meeting;
    }
}

