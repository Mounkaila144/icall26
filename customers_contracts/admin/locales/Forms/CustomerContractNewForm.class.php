<?php

require_once dirname(__FILE__)."/ProductsMultipleNewForm.class.php";
require_once dirname(__FILE__)."/CustomerContractNewBaseForm.class.php";
require_once dirname(__FILE__)."/CustomerAttributionsForNewContractForm.class.php";

class CustomerContractNewForm extends mfForm {
    
    protected $user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user=$user;
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new CustomerContractSettings():$this->settings;
    }
         
    function configure()
    {                             
       $this->embedForm('contract', new CustomerContractNewBaseForm($this->getDefault('contract')));                         
       $this->embedForm('customer', new CustomerBaseForm($this->getDefault('customer')));  
       $this->embedForm('attributions', new CustomerAttributionsForNewContractForm($this->getUser(),$this->getDefault('attributions')));  
       $this->embedForm('address', new CustomerAddressBaseForm($this->getDefault('address')));   
       //$this->embedForm('contact', new CustomerContactBaseForm($this->getDefault('contact'))); 
       //$this->embedForm('products', new ProductsMultipleNewForm($this->getUser(),$this->getDefault('products')));
        if (!$this->getUser()->hasCredential(array(array('contract_new_remove_products'))))  	   
        {            
             $has_products=(boolean)$this->getDefault('products');                
             $this->embedForm('products', new ProductsMultipleNewForm($this->getUser(),$this->getDefault('products')));               
             if (!$has_products)       
                    $this->products->setOption('required',false);                               
        }       
       if ($this->getUser()->hasCredential(array(array('contract_new_opened_at_not_required'))))    
           $this->contract['opened_at']->setOption('required',false);
        if ($this->getUser()->hasCredential(array(array('contract_new_remove_opened_at'))))    
           unset($this->contract['opened_at']); 
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_closed_at'))))
       {
          $this->contract->addValidator('closed_at',new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_company'))))
       {
          $this->customer->addValidator('company',new mfValidatorString(array("required"=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_hastva'))))
       {
          $this->contract->addValidator('has_tva',new mfValidatorBoolean(array("empty_value"=>"NO","true"=>"YES","false"=>"NO","return_value"=>true)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_opc_at_remove'))))
       {
           unset($this->contract['opc_at']);
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_payment_at_remove'))))
       {
           unset($this->contract['payment_at']);
       }      
        if ($this->getUser()->hasCredential(array(array('contract_new_apf_at_remove'))))
       {
           unset($this->contract['apf_at']);
       }
       if ($this->getUser()->hasCredential(array(array('contract_new_opc_at_datetime'))))
       {          
          $this->contract->addValidator('opc_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));
       } 
       if ($this->contract->hasValidator('opc_at') && $this->getUser()->hasCredential(array(array('contract_new_opc_at_required'))))
       {          
          $this->contract['opc_at']->setOption('required',true);
       } 
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_time_state'))))
       {
            $this->contract->addValidator('time_state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractTimeStatus::getStatusForI18nSelect())));
       } 
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_new_opc_range'))))
       {
            $this->contract->addValidator('opc_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));
       } 
       if ($this->getUser()->hasCredential(array(array('contract_new_opc_at_datetime_from_installation'))))
       {                
          unset($this->contract['opc_at']);
       } 
       if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','contract_new_polluter'))))
       {              
            
            if($this->getUser()->hasCredential(array(array('contract_meeting_polluter_default_value'))))
             {
              $this->contract->addValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>PartnerPolluterCompany::getPollutersForSelect()))); 
             }
             else
             {
                $this->contract->addValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>PartnerPolluterCompany::getPollutersForSelect()->unshift(array(""=>__("Not defined")))))); 
             }
            
       } 
       if ($this->getSettings()->hasLayer() && $this->getUser()->hasCredential(array(array('superadmin','contract_new_partner_layer'))))
       {                          
            $this->contract->addValidator('partner_layer_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerLayerCompany::getLayersForSelect())));                                      
       } 
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_sav_at_date'))))
       {          
          $this->contract->addValidator('sav_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
       } 
       if ($this->getUser()->hasCredential(array(array('contract_new_sav_at_required'))))
       {          
          $this->contract->addValidator('sav_at',new mfValidatorI18nDate(array("date_format"=>"a")));
       }
       if ($this->getUser()->hasCredential(array(array('contract_new_sav_at_range'))))
       {                         
           $this->contract->addValidator('sav_at_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_new_admin_status'))))
       {           
            $this->contract->addValidator('admin_status_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractAdminStatus::getStatusForI18nSelect())));
       } 
       if ($this->contract->hasValidator('pre_meeting_at') && $this->getUser()->hasCredential(array(array('superadmin','contract_new_pre_meeting_at_date'))))
       {          
           $this->contract->addValidator('pre_meeting_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
       } 
       if ($this->contract->hasValidator('pre_meeting_at') && $this->getUser()->hasCredential(array(array('contract_new_pre_meeting_at_datetime'))))
       {             
          $this->contract->addValidator('pre_meeting_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));
       }       
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_remarks'))))
       {          
          $this->contract->addValidator('remarks',new mfValidatorString(array("required"=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_doc_at_date'))))
       {          
           if (!$this->getDefaults())
                $this->defaults['contract']['doc_at']=date('Y-m-d');
           $this->contract->addValidator('doc_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
           if ($this->getUser()->hasCredential(array(array('contract_new_doc_at_required'))))
                  $this->contract['doc_at']->setOption('required',true);   
       } 
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_is_billable'))))                                      
            $this->contract->addValidator('is_billable', new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));
       if ($this->getUser()->hasCredential(array(array('contract_new_total_price_with_taxe_remove'))))                            
            unset($this->contract['total_price_with_taxe']);
       if ($this->getUser()->hasCredential(array(array('contract_new_total_price_without_taxe_remove'))))                            
            unset($this->contract['total_price_without_taxe']);
       if ($this->getUser()->hasCredential(array(array('contract_new_tax_id_remove'))))                            
            unset($this->contract['tax_id']);    
       if ($this->contract->hasValidator('pre_meeting_at') && $this->getUser()->hasCredential(array(array('contract_new_pre_meeting_at_required'))))               
           $this->contract['pre_meeting_at']->setOption('required',true);
       unset($this->contract['id'],$this->address['id'],
             $this->customer['id'],$this->address['country']
               );
       if ($this->getUser()->hasCredential(array(array('contract_new_remove_state'))))                 
          unset($this->contract['state_id']);   
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_quoted_at_date'))))              
          $this->contract->addValidator('quoted_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));  
       if ($this->getUser()->hasCredential(array(array('contract_new_quoted_at_required'))))               
           $this->contract['quoted_at']->setOption('required',true);
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_billing_at_date'))))              
          $this->contract->addValidator('billing_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
       if ($this->getUser()->hasCredential(array(array('contract_new_billing_at_required'))))               
           $this->contract['billing_at']->setOption('required',true);
       if ($this->getUser()->hasCredential(array(array('contract_new_reference_remove'))))     
           unset($this->contract['reference']);   
       if ($this->getUser()->hasCredential(array(array('contract_new_financial_partner_remove'))))                   
          unset($this->contract['financial_partner_id']);     
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_new_contract_company'))))                    
           $this->contract->addValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));            
       $this->validatorSchema->setPostValidator(new mfValidatorCallbacks(new mfArray(array(array($this, 'check')))));
       if ($this->getUser()->hasCredential(array(array('superadmin_debugxxx','contract_new_check_dates','contract_new_check_dates_engine'))))
       {          
          $this->validatorSchema->getPostValidator()->getCallbacks()->push(array($this,'checkDates'));
          $this->contract->addValidator('is_opened_dates',new mfValidatorBoolean(array()));   
       }  
    /*    if ($this->getSettings()->hasLayer() && $this->getUser()->hasCredential(array(array('contract_new_partner_layer_by_distance'))))
       {                          
            $this->contract->addValidator('partner_layer_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+PartnerLayerCompany::getLayersForSelect())));                                      
       } */
    }
    
    function checkDates($validator,$values)
    {                  
        if ($this->hasErrors())
            return $values;      
        if ($this->getUser()->hasCredential(array(array('contract_new_check_dates_engine'))))    
        {         
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.new.check.dates',array('values'=>$values,'validator'=>$validator))); 
            return $values;
        }
        
        $errors_schema=array();
        $day=new Day();
        $is_opened_dates=$this->contract->hasValidator('is_opened_dates')?$values['contract']['is_opened_dates']:false;        
        $sav_date=$this->contract->hasValidator('sav_at')?new Day($values['contract']['sav_at']):$day;                     
         if ($this->contract->hasValidator('pre_meeting_at') && $values['contract']['pre_meeting_at'])
        {                      
            $errors=new mfArray();
            $pre_meeting_date=new Day($values['contract']['pre_meeting_at']);                        
            if ($sav_date->getDate() < $pre_meeting_date->getDate() && ! $is_opened_dates)    
                $errors[]=__('lower than sav date');                            
            if (!$errors->isEmpty())
               $errors_schema['pre_meeting_at']=new mfValidatorError($this->contract['pre_meeting_at'],__("Premeeting date has to be ").$errors->implode(__(" and ")));            
        } 
                
        if ($this->contract->hasValidator('quoted_at'))
        {              
            $errors=new mfArray();
            $quoted_date=new Day($values['contract']['quoted_at']);  
            $pre_meeting_date=new Day($values['contract']['pre_meeting_at']);    
            if ($sav_date->getDate() < $quoted_date->getDate() && ! $is_opened_dates)       
                $errors[]=__('lower than sav date');                
            if ($quoted_date->getDate() < $pre_meeting_date->getDate())                            
                $errors[]=__('upper than pre meeting date');
            if (!$errors->isEmpty())
               $errors_schema['quoted_at']=new mfValidatorError($this->contract['quoted_at'],__("Quotation date has to be ").$errors->implode(__(" and ")));            
        }
        
        if ($this->contract->hasValidator('opened_at'))
        {        
            $errors=new mfArray();
            $quoted_date=$this->contract->hasValidator('quoted_at')?new Day($values['contract']['quoted_at']):$day;       
            $opened_date=new Day($values['contract']['opened_at']);                        
            if ($sav_date->getDate() < $opened_date->getDate() && ! $is_opened_dates)       
                $errors[]=__('lower than sav date');       
            if ($opened_date->getDate() < $quoted_date->getDate())                            
                $errors[]=__('upper than quotation date');
            if (!$errors->isEmpty())
               $errors_schema['opened_at']=new mfValidatorError($this->contract['quoted_at'],__("Opened date has to be ").$errors->implode(__(" and ")));            
           
        } 
                       
        if ($this->contract->hasValidator('billing_at'))
        {     
            $errors=new mfArray();
            $billing_date=new Day($values['contract']['billing_at']);     
            $opened_date=$this->contract->hasValidator('opened_at')?new Day($values['contract']['opened_at']):$day; 
            if ($sav_date->getDate() < $billing_date->getDate() && ! $is_opened_dates)       
                $errors[]=__('lower than sav date');    
            if ($billing_date->getDate()  < $opened_date->getDate())                            
                $errors[]=__('upper than opened date');
            if (!$errors->isEmpty())
               $errors_schema['billing_at']=new mfValidatorError($this->contract['billing_at'],__("Billing date has to be ").$errors->implode(__(" and ")));            
           
        }                                   
        if ($this->contract->hasValidator('opc_at'))
        {     
            $errors=new mfArray();
            $opc_date=new Day($values['contract']['opc_at']);  
            $billing_date=$this->contract->hasValidator('billing_at')?new Day($values['contract']['billing_at']):$day; 
            if ($sav_date->getDate() < $opc_date->getDate() && ! $is_opened_dates)      
                $errors[]=__('lower than sav date');   
             if ($opc_date->getDate() < $billing_date->getDate())                            
                $errors[]=__('upper than billing date');                                  
             if (!$errors->isEmpty())
               $errors_schema['opc_at']=new mfValidatorError($this->contract['opc_at'],__("Opc date has to be ").$errors->implode(__(" and ")));            
           
        } 
      /*  if ($this->contract->hasValidator('payment_at') && $values['contract']['payment_at'])
        {
            $errors=new mfArray();
            $payment_date=new Day($values['contract']['payment_at']);  
            $billing_date=$this->contract->hasValidator('billing_at')?new Day($values['contract']['billing_at']):$day; 
            if ($payment_date->getDate() > $billing_date->getDate())                            
                $errors[]=__('lower than billing date');        
            $opened_date=$this->contract->hasValidator('opened_at')?new Day($values['contract']['opened_at']):$day;                         
            if ($payment_date->getDate() < $opened_date->getDate())                            
                $errors[]=__('upper than opened date');                                  
            if (!$errors->isEmpty())
               $errors_schema['contract']['payment_at']=new mfValidatorError($this->contract['payment_at'],__("Payment date has to be ").$errors->implode(__(" and ")));    
        }   */
        if ($errors_schema)
            throw new mfValidatorErrorSchema($validator,array('contract'=>new mfValidatorErrorSchema($this->contract,$errors_schema)));
        return $values;
    }

   
    function getProducts()
    {               
        if (!$this->getDefault('products') && $this->isValid())
        {                     
                return ProductSettings::load()->getDefaultContractProducts();                      
        }        
        return $this['products']['collection']->getValues();                
    }
    
    function getDefaultValuesForContract()
    {                           
        if (!$this->getDefault('contract') && $this->getUser()->hasCredential(array(array('superadmin_debug','contract_new_opened_at_today'))))
            $this->defaults['contract']['opened_at']=date("Y-m-d");    
        if (!$this->getDefault('contract') && $this->getUser()->hasCredential(array(array('superadmin_debugxxx','contract_new_check_dates'))))  
        {                    
             $day=new Day();             
            if (!$this->defaults['contract']['sav_at'])
                $this->defaults['contract']['sav_at']=$day->getDate();
            if (!$this->defaults['contract']['pre_meeting_at'])
                $this->defaults['contract']['pre_meeting_at']=$day->getDate();
            if (!$this->defaults['contract']['opened_at'])
                $this->defaults['contract']['opened_at']=$day->getDate();
            if (!$this->defaults['contract']['quoted_at'])
                $this->defaults['contract']['quoted_at']=$day->getDate();  // $day->getDaySub(7)->getDate();
            if (!$this->defaults['contract']['billing_at'])
                $this->defaults['contract']['billing_at']=$day->getDate();
            if (!$this->defaults['contract']['doc_at'])
                $this->defaults['contract']['doc_at']=$day->getDate();  // $day->getDayAdd(1)->getDate();
             if (!$this->defaults['contract']['opc_at'])
                $this->defaults['contract']['opc_at']=$day->getDate();  // $day->getDayAdd(1)->getDate(); 
        }                 
        $this->defaults['contract']['state_id']=$this->getSettings()->get('default_status_id');     
        if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','contract_new_polluter'))))
        {        
            if (!$this->defaults['contract']['polluter_id'])
            {                                                   
                $this->defaults['contract']['polluter_id']=$this->getDefaultPolluter()->get('id');                         
            }
        }  
        if ($this->getUser()->hasCredential(array(array('contract_new_company_by_user'))) && !isset($this->defaults['contract']['company_id']))
        {              
           if ($this->getUser()->getGuardUser()->hasCompany())
               $this->defaults['contract']['company_id']=$this->getUser()->getGuardUser()->get('company_id');
           else
              $this->defaults['contract']['company_id']=$this->getSettings()->get('default_company_id');                                 
        }          
        if (!isset($this->defaults['contract']['company_id']))
        {                                                   
            $this->defaults['contract']['company_id']=$this->getSettings()->get('default_company_id');                         
        }      
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.new.form.defaults.config'));  
        return $this->getDefault('contract');
    }
    
    function check($validator,$values)
    {               
        if ($this->hasErrors())
            return $values;
       
        return $values;
    }
    
    function getDefaultPolluter()
    {
        return $this->default_polluter=$this->default_polluter===null?PartnerPolluterCompany::getDefault():$this->default_polluter;
    }
    
    
     function hasPolluter()
    {                 
        if ($this->isReady())
        {
            if ($this->contract->hasValidator('polluter_id'))
                return (boolean)$this['contract']['polluter_id']->getValue();
            return $this->getDefaultPolluter()->isLoaded();
        } 
        else
        {            
            if ($this->contract->hasValidator('polluter_id')) 
                return $this->defaults['contract']['polluter_id'];
            return $this->getDefaultPolluter()->isLoaded();
        }           
    }
    
    
    /*function setContract(CustomerContract $contract)
    {
        $this->_contract=$contract;
        return $this;
    }*/
    
    function getContract()
    {
        if ($this->_contract===null)
        {            
            if ($this->hasValidator('id'))
            {                             
                 $this->_contract=$this->isValid()?$this['id']->getValue():new CustomerContract($this->getDefault('id'));  
            }   
            else
            {    
                $this->_contract=new CustomerContract();  
                $this->_contract->add($this->getDefaultValuesForContract());       
            }
        }   
        return $this->_contract;
    }
    
       
}
