<?php



class MultipleContractProcessSelectionForm extends mfForm {

    protected $user=null,$selection=null,$_actions=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {           
        $this->_actions=new mfArray();
        $settings=  CustomerContractSettings::load();
        if (!$this->hasDefaults())
        {    
            $this->setDefaults(array(
               // 'in_at'=>array('date'=>date('Y-m-d'),'hour'=>'06','minute'=>'00'),
              //  'in_at'=>date("Y-m-d")." 06:00:00",
              //  'created_at'=>date('Y-m-d')
            ));
        }
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(),   
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))),            
        ));             
        $this->setValidator('reference',new mfValidatorString(array("required"=>false)));            
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_multiple_range_opc_at'))))
        {        
             $this->_actions->push("range_opc_at");
             $this->setValidator('opc_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a"))); 
             $this->setValidator('opc_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No range"))+CustomerContractRange::getRangesForI18nSelect())));
        }
        elseif ($this->getUser()->hasCredential(array(array('contract_multiple_date_opc_at'))))
        {
            $this->_actions->push("date_opc_at");
            $this->setValidator('opc_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a"))); 
        }
        elseif ($this->getUser()->hasCredential(array(array('contract_multiple_datetime_opc_at'))))
        {
             $this->_actions->push("datetime_opc_at");
             $this->setValidator('opc_at',new mfValidatorI18nDateTime(array("required"=>false,'empty_value'=>null,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));              
        }            
        $this->setValidator('opened_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));                    
        $this->setValidator('doc_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));                    
        $this->setValidator('telepro_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No teleprospector"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('TELEPRO',$this->getUser()))));                
        $this->setValidator('sale1_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
        $this->setValidator('sale2_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
        $this->setValidator('meeting_sale2_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
        $this->setValidator('state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractStatusUtils::getStatusForI18nSelect())));
        $this->setValidator('admin_status_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractAdminStatus::getStatusForI18nSelect())));
        $this->setValidator('financial_partner_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerUtils::getPartnerForSelect())));
        $this->setValidator('email_customer_model_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerModelEmailUtils::getModelEmailsForSelect())));
        $this->setValidator('sms_customer_model_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerModelSmsUtils::getModelSmsForSelect())));                         
        $this->setValidator('opc_status_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractOpcStatus::getStatusForI18nSelect())));
        $this->setValidator('time_state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+ CustomerContractTimeStatus::getStatusForI18nSelect())));
        $this->setValidator('install_state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+ CustomerContractInstallStatus::getStatusForI18nSelect())));
        if ($settings->hasAssistant())
        {    
            $this->setValidator('assistant_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No assistant"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('ASSISTANT',$this->getUser()))));                
        }
        if ($settings->hasPolluter())
        {    
            $this->setValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>PartnerPolluterCompany::getPollutersForSelect2()->unshift(array(""=>__("Not defined"))))));                
        }  
        if ($this->getUser()->hasCredential(array(array('contract_multiple_pre_meeting_at_date'))))
        {        
             $this->_actions->push("pre_meeting_at");
             $this->setValidator('pre_meeting_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));              
        }
        elseif ($this->getUser()->hasCredential(array(array('superadmin','contract_multiple_pre_meeting_at_datetime'))))
        {        
             $this->_actions->push("pre_meeting_at");
             $this->setValidator('pre_meeting_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));                 
        }        
        
        foreach (array("state","sms_customer","products_by_default","telepro","assistant","reference","team_from_telepro","polluter",
                        "remove_opc_at_date","sale1","sale2","hold","unhold","opc_at_range","opened_at" ,  
                        "email_customer","opc_at_time_to_range",'admin_status','sav_at_equal_opc_at','opc_at_equal_sav_at',
                        "meeting_sale2","date_doc_at","time_state","generate_coordinates",
                        "financial_partner","opc_status","install_state") as $action)
        {
            if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_multiple_'.$action))))
            {        
                $this->_actions->push($action);
            }
        }    
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_multiple_status_delete_and_active'))))
        {                        
            $this->_actions->push("status_delete");
            $this->_actions->push("status_active");
        }
        mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this, 'contracts.multiple.form.config'));   
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->_actions->toArray())));      
    }
    
    function getActions()
    {
        return $this->_actions;
    }
    
    
    function getSelection()
    {
        return $this['selection']->getArray();        
    }
       
    function getSelectionCount()
    {
        return count($this['selection']->getValue());
    }
    
    function setSelection($selection)
    {
        $this->setDefault('selection', $selection);
        $this->setDefault('count', count($selection));
    }
    
   /*  function getSelectionJson()
    {
        return json_encode($this['selection']->getValue());
    }*/
    
   /* function getSelection()
    {
        return new mfArray($this['selection']->getValue());
    }*/
    
    function hasAction($action)
    {
        return in_array($action,(array)$this['actions']->getValue());
    }
    
    function hasActions()
    {           
        return $this['actions']->getValue();
    }
    
  
    
    function getSelectionForUrl()
    {       
         return http_build_query(array('selection'=>(string)$this->getSelection()->implode()));
    }
    
    function hasActionInValidator($action)
    {
        return in_array($action,$this->actions->getOption('choices'));
    }
    
     function getOpcAtHour()
    {               
        if ($this->getValue('opc_at'))
            return date("H",strtotime($this['opc_at']->getValue()));   
        return null;
    }
    
    function getOpcAtMinute()
    {
        if ($this->getValue('opc_at'))
            return date("i",strtotime($this['opc_at']->getValue()));       
        return null;
    }
    
    function getOpcAtDate()
    {       
        if ($this->getValue('opc_at'))
            return date("Y-m-d",strtotime($this['opc_at']->getValue()));      
        return null;
    }
    
    function getPreMeetingAtHour()
    {               
        if ($this->getValue('pre_meeting_at'))
            return date("H",strtotime($this['pre_meeting_at']->getValue()));   
        return null;
    }
    
    function getPreMeetingAtMinute()
    {
        if ($this->getValue('pre_meeting_at'))
            return date("i",strtotime($this['pre_meeting_at']->getValue()));       
        return null;
    }
    
    function getPreMeetingAtDate()
    {       
        if ($this->getValue('pre_meeting_at'))
            return date("Y-m-d",strtotime($this['pre_meeting_at']->getValue()));      
        return null;
    }
}