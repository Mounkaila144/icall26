<?php



class CustomerContractViewForm extends CustomerContractBaseForm {
    
    protected $user=null,$_contract=null,$settings=null;
    
    function __construct($user,$contract,$defaults = array()) {
        $this->user=$user;
        $this->_contract=$contract;
        $this->settings=new CustomerContractSettings();
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }
         
    function getContract()
    {
        return $this->_contract;
    }
    
    function getSettings()
    {
       return $this->settings;    
    }
    
    function configure()
    {      
       if ($this->getContract()->isHold())
       {
          $builder=new CustomerContractHoldViewFormBuilder($this->getUser(),$this);
          $builder->configure();                  
       }
       else 
       {                         
            parent::configure();        
            $this->addValidators(array(              
                     'financial_partner_id'=> new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+PartnerUtils::getPartnerForSelect())),   
                     'tax_id'=> new mfValidatorChoice(array('key'=>true,'choices'=>TaxUtils::getTaxesForSelect())),              
            ));                  
            if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_state'))))
            {
                 $this->setValidator('state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractStatusUtils::getStatusForI18nSelect())));
            }         
            if ($this->getUser()->hasCredential(array(array('contract_turnover_hidden','contract_turnover_remove'))))
            {
                unset($this['tax_id'],$this['total_price_without_taxe'],$this['total_price_with_taxe']);
            } 
            if ($this->getUser()->hasCredential(array(array('contract_turnover_with_tax_hidden','contract_turnover_with_tax_remove'))))
            {            
               unset($this['total_price_with_taxe']);  
            } 
            if ($this->getUser()->hasCredential(array(array('contract_turnover_without_tax_hidden','contract_turnover_without_tax_remove'))))
            {               
               unset($this['total_price_without_taxe']);
            } 
            if ($this->getUser()->hasCredential(array(array('contract_turnover_tax_rate_hidden','contract_turnover_tax_rate_remove'))))
            {
               unset($this['tax_id']); 
            } 
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_closed_at'))))
            {        
               $this->setValidator('closed_at',new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)));
            }  
             if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_hastva'))))
            {
               $this->setValidator('has_tva',new mfValidatorBoolean(array("empty_value"=>"NO","true"=>"YES","false"=>"NO")));
            }
             if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_advance_payment'))))
            {
               $this->setValidator('advance_payment',new mfValidatorI18nNumber(array("required"=>false)));
            }            
             if ($this->getUser()->hasCredential(array(array('contract_modify_opc_at_datetime'))))
            {          
               $this->setValidator('opc_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));
            }  
            if ($this->hasValidator('opc_at') && $this->getUser()->hasCredential(array(array('contract_opc_at_required'))))
            {          
               $this->opc_at->setOption('required',true);
            }  
            if ($this->hasValidator('opened_at') && $this->getUser()->hasCredential(array(array('contract_opened_at_required'))))
            {          
               $this->opened_at->setOption('required',true);
            } 
            if ($this->hasValidator('opened_at') && $this->getUser()->hasCredential(array(array('contract_opened_at_not_required'))))
            {          
               $this->opened_at->setOption('required',false);
            }
            if ($this->getUser()->hasCredential(array(array('contract_modify_opc_at_datetime_from_installation','contract_display_opc_at','contract_view_no_opc_at'))))
            {          
               unset($this['opc_at']);
            }
            if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_polluter'))))
            {    
                if($this->getUser()->hasCredential(array(array('contract_meeting_polluter_default_value'))))
                {
                  $this->setValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>PartnerPolluterCompany::getPollutersForSelect2()))); 
                }
                else
                {
                    $this->setValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>PartnerPolluterCompany::getPollutersForSelect2()->unshift(array(""=>__("Not defined")))))); 
                }
            }
            
            if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_install_state'))))
            {
                 $this->setValidator('install_state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractInstallStatus::getStatusForI18nSelect())));
            } 
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_time_state'))))
            {
                 $this->setValidator('time_state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractTimeStatus::getStatusForI18nSelect())));
            } 
            if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_opc_range'))))
            {
                 $this->setValidator('opc_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));
            }       
            if ($this->getUser()->hasCredential(array(array('contract_modify_no_reference'))))
            {
                 unset($this['reference']);
            } 
            if ($this->getUser()->hasCredential(array(array('contract_modify_no_financial_partner_id'))))
            {
                 unset($this['financial_partner_id']);
            } 
            if ($this->getUser()->hasCredential(array(array('contract_modify_no_payment_at'))))
            {
                 unset($this['payment_at']);
            }
             if ($this->getUser()->hasCredential(array(array('contract_modify_no_opened_at','contract_modify_remove_opened_at'))))
            {
                 unset($this['opened_at']);
            }
             if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_opc_status'))))
            {
                 $this->setValidator('opc_status_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractOpcStatus::getStatusForI18nSelect())));
            } 
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_sav_at_date'))))
            {          
               $this->setValidator('sav_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
            }
            if ($this->getUser()->hasCredential(array(array('contract_modify_sav_at_range'))))
            {                         
               $this->setValidator('sav_at_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));
            }
            if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_admin_status'))))
            {
                 $this->setValidator('admin_status_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractAdminStatus::getStatusForI18nSelect())));
            }   
            if ($this->getSettings()->hasLayer() && $this->getUser()->hasCredential(array(array('superadmin','contract_modify_partner_layer'))))
            {                          
                 $this->setValidator('partner_layer_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerLayerCompany::getLayersForSelect())));                                      
            }
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_contract_company'))))  
            {
                $this->setValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));      
            }
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_doc_at_date'))))
            {          
               $this->setValidator('doc_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
               if ($this->getUser()->hasCredential(array(array('contract_view_doc_at_required'))))
                  $this->doc_at->setOption('required',true);  
               if (!$this->getContract()->hasDocAt())
                   $this->getContract()->set('doc_at',date('Y-m-d'));
            }
            if ($this->getUser()->hasCredential(array(array('contract_modify_pre_meeting_at_date'))))                   
               $this->setValidator('pre_meeting_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));        
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_pre_meeting_at_datetime'))))            
                $this->setValidator('pre_meeting_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>9,"hour_max"=>23)));       
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_is_billable'))))                                      
                $this->setValidator('is_billable', new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));                                                
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_remarks'))))       
                $this->setValidator('remarks',new mfValidatorString(array("required"=>false)));    
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_quoted_at_date'))))        
                $this->setValidator('quoted_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));       
            if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_billing_at_date'))))        
                $this->setValidator('billing_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));   
            if ($this->hasValidator('sav_at') && $this->getUser()->hasCredential(array(array('contract_sav_at_date_required'))))                     
                $this->sav_at->setOption('required',true);      
            if ($this->hasValidator('pre_meeting_at') && $this->getUser()->hasCredential(array(array('contract_pre_meeting_at_date_required'))))                     
                $this->pre_meeting_at->setOption('required',true); 
            if ($this->hasValidator('quoted_at') && $this->getUser()->hasCredential(array(array('contract_quoted_at_date_required'))))                     
                $this->quoted_at->setOption('required',true); 
            if ($this->hasValidator('billing_at') && $this->getUser()->hasCredential(array(array('contract_billing_at_date_required'))))                     
                $this->billing_at->setOption('required',true); 
            if ($this->getUser()->hasCredential(array(array('contract_modify_billing_at_date_removed'))))        
                unset($this['billing_at']);
            if ($this->getUser()->hasCredential(array(array('contract_modify_quoted_at_date_removed'))))        
                unset($this['quoted_at']);
            if ($this->getUser()->hasCredential(array(array('contract_modify_sav_at_date_removed'))))        
                unset($this['sav_at']);          
            if ($this->getContract()->isSigned() && $this->getUser()->hasCredential(array(array('contract_modify_signed_dates_not_modified'))))                                               
            {                     
                 foreach (array('billing_at','pre_meeting_at','quoted_at','opc_at','opened_at','doc_at','sav_at') as $field)
                 {                     
                     if (!$this->getDefault($field) && $this->hasValidator($field))
                     {             
                         
                         unset($this[$field]);
                     }    
                 }                       
            }
            if ($this->getContract()->isSigned() && $this->getUser()->hasCredential(array(array('contract_signed_dates_modify'))))                                               
            {                     
                 foreach (array('billing_at','opc_at') as $field)
                 {                     
                    $this->setValidator($field,new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));    
                 }                       
            }
       }
       
    // echo "<pre>";  var_dump(new mfArray(array(array($this, 'check'))));
       
        $this->validatorSchema->setPostValidator(new mfValidatorCallbacks(new mfArray(array(array($this, 'check')))));
        if ($this->getUser()->hasCredential(array(array('superadmin_debugxxx','contract_view_check_dates')))) 
        {         
          $this->validatorSchema->getPostValidator()->getCallbacks()->push(array($this,'checkDates'));     
        }
        $this->setValidator('is_opened_dates',new mfValidatorBoolean(array()));      
        
      //  file_put_contents(__DIR__."/debug.txt", var_export($this->validatorSchema->getPostValidator()->getCallbacks(),true));
    }
    
    
          
    
   
    function checkDates($validator,$values)
    {                   
        if ($this->hasErrors())
            return $values;      
        if ($this->getUser()->hasCredential(array(array('contract_view_check_dates_engine'))))    
        {                      
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.view.check.dates',array('values'=>$values,'validator'=>$validator))); 
            return $values;
        }        
        $errors_schema=array();               
        $is_opened_dates=$this->hasValidator('is_opened_dates')?$values['is_opened_dates']:false;
        $sav_date=$this->hasValidator('sav_at')?new Day($values['sav_at']):$this->getContract()->getFormatter()->getSavAt();                     
         if ($this->hasValidator('pre_meeting_at') && $values['pre_meeting_at'])
        {                      
            $errors=new mfArray();
            $pre_meeting_date=new Day($values['pre_meeting_at']);                        
            if ($sav_date->getDate() < $pre_meeting_date->getDate() && !$is_opened_dates)    
                $errors[]=__('lower than sav date');                         
            if (!$errors->isEmpty())
               $errors_schema['pre_meeting_at']=new mfValidatorError($this->pre_meeting_at,__("Premeeting date has to be ").$errors->implode(__(" and ")));            
        } 
                
        if ($this->hasValidator('quoted_at'))
        {              
            $errors=new mfArray();
            $quoted_date=new Day($values['quoted_at']);                        
            if ($sav_date->getDate() < $quoted_date->getDate() && !$is_opened_dates)   
                $errors[]=__('lower than sav date');            
            $pre_meeting_date=$this->hasValidator('pre_meeting_at')?$pre_meeting_date:$this->getContract()->getFormatter()->getPreMeetingAt();                  
            if ($pre_meeting_date)
            {    
            if ($quoted_date->getDate() < $pre_meeting_date->getDate())                            
                $errors[]=__('upper than pre meeting date');
            if (!$errors->isEmpty())
               $errors_schema['quoted_at']=new mfValidatorError($this->quoted_at,__("Quotation date has to be ").$errors->implode(__(" and ")));            
            }
        }
        
        if ($this->hasValidator('opened_at'))
        {        
            $errors=new mfArray();
            $quoted_date=$this->hasValidator('quoted_at')?new Day($values['quoted_at']):$this->getContract()->getFormatter()->getQuotedAt();       
            $opened_date=new Day($values['opened_at']);                        
            if ($sav_date->getDate() < $opened_date->getDate() && !$is_opened_dates)   
                $errors[]=__('lower than sav date');       
            if ($opened_date->getDate() < $quoted_date->getDate())                            
                $errors[]=__('upper than quotation date');
            if (!$errors->isEmpty())
               $errors_schema['opened_at']=new mfValidatorError($this->quoted_at,__("Opened date has to be ").$errors->implode(__(" and ")));            
           
        } 
                       
        if ($this->hasValidator('billing_at'))
        {     
            $errors=new mfArray();
            $billing_date=new Day($values['billing_at']);     
            $opened_date=$this->hasValidator('opened_at')?new Day($values['opened_at']):$this->getContract()->getFormatter()->getBillingAt(); 
            if ($sav_date->getDate() < $billing_date->getDate() && !$is_opened_dates)   
                $errors[]=__('lower than sav date');    
            if ($billing_date->getDate()  < $opened_date->getDate())                            
                $errors[]=__('upper than opened date');
            if (!$errors->isEmpty())
               $errors_schema['billing_at']=new mfValidatorError($this->billing_at,__("Billing date has to be ").$errors->implode(__(" and ")));            
           
        }                                   
        if ($this->hasValidator('opc_at'))
        {     
            $errors=new mfArray();
            $opc_date=new Day($values['opc_at']);  
            $billing_date=$this->hasValidator('billing_at')?new Day($values['billing_at']):$this->getContract()->getFormatter()->getOpcAt(); 
            if ($sav_date->getDate() < $opc_date->getDate() && !$is_opened_dates)   
                $errors[]=__('lower than sav date');   
             if ($opc_date->getDate() < $billing_date->getDate())                            
                $errors[]=__('upper than billing date');                                  
             if (!$errors->isEmpty())
               $errors_schema['opc_at']=new mfValidatorError($this->opc_at,__("Opc date has to be ").$errors->implode(__(" and ")));            
           
        }        
        if ($errors_schema)
            throw new mfValidatorErrorSchema($validator,$errors_schema);
        return $values;
    }
   
    function getValues()
    {
        $values=parent::getValues();
        if ($this->getUser()->hasCredential(array(array('contract_set_opc_at_if_empty'))))
        {       
           if (!$this->getValue('opc_at'))
           {
              $day = new Day($this->getValue('opened_at'));            
              $values['opc_at']=(string)$day->getDayAdd(CustomerContractSettings::load()->get('number_of_day_for_opc',1));
           }   
        }        
        if (!$this->getContract()->isSigned() && $this->getUser()->hasCredential(array(array('contract_modify_signed_dates_not_modified'))))                                                 
        {
            foreach (array('billing_at','pre_meeting_at','quoted_at','opc_at','opened_at','doc_at','sav_at') as $field)
            {        
                if ($this->hasValidator($field) && !$values[$field])
                     unset($values[$field]);
            }                
        } 
         if ($this->getContract()->isSigned() && $this->getUser()->hasCredential(array(array('contract_modify_signed_dates_not_modified'))))                                                 
        {
            foreach (array('opened_at') as $field)
            {        
                if ($this->hasValidator($field))
                   unset($values[$field],$this[$field]);
            }                
        } 
        return $values;
    }

    
    function check($validator,$values)
    {        
        if ($this->hasErrors())
            return $values;
        if ($this->getUser()->hasCredential(array(array('contract_view_opc_at_above_or_equal_opened_at'))))
        {
             if (isset($values['opc_at']) && isset($values['opened_at']))
             {
                 if ($values['opc_at'] < $values['opened_at'])
                    throw new mfValidatorErrorSchema($validator,array("opc_at"=>new mfValidatorError($this->opc_at,__('Opc date has to be higher than opened date'))));
             }        
        }             
        return $values;
    }
    
    
      function hasPolluter()
    {        
        if (!$this->getDefault('contract') || $this->contract->hasValidator('polluter_id'))
            return $this->getContract()->hasPolluter();          
        return $this->isReady()?(boolean)$this['contract']['polluter_id']->getValue():(boolean)$this->defaults['contract']['polluter_id'];    
    }
    
}
