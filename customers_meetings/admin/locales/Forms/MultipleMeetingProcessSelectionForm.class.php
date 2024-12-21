<?php



class MultipleMeetingProcessSelectionForm extends mfForm {

    protected $user=null;
    
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
        $settings=  CustomerMeetingSettings::load();
        if (!$this->hasDefaults())
        {    
            $this->setDefaults(array(
               // 'in_at'=>array('date'=>date('Y-m-d'),'hour'=>'06','minute'=>'00'),
                'in_at'=>date("Y-m-d")." 06:00:00",
                'created_at'=>date('Y-m-d')
            ));
        }
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(),   
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))),            
        ));            
        $this->setValidator('created_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
        $this->setValidator('treated_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
        $this->setValidator('in_at',new mfValidatorI18nDateTime(array("required"=>false,'empty_value'=>null,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));             
        $this->setValidator('telepro_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No teleprospector"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('TELEPRO',$this->getUser()))));                
        $this->setValidator('sales_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
        $this->setValidator('sale2_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
        $this->setValidator('contract_sale2_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('SALES',$this->getUser()))));
        $this->setValidator('state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerMeetingStatusUtils::getStatusForI18nSelect())));
        $this->setValidator('sms_customer_model_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerModelSmsUtils::getModelSmsForSelect())));        
        $this->setValidator('email_customer_model_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerModelEmailUtils::getModelEmailsForSelect())));        
        $this->setValidator('email_sale1_model_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>UserModelEmailUtils::getModelEmailsForSelect())));        
        $this->setValidator('email_sale2_model_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>UserModelEmailUtils::getModelEmailsForSelect())));        
        //$this->setValidator('pr',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerModelSmsUtils::getModelSmsForSelect())));        
       // Model Email sale 1 / 2 
       // Model SMS sale 1 / 2
         if ($settings->hasCallcenter())
        {    
            $this->setValidator('callcenter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No callcenter"))+Callcenter::getCallcenterForSelect())));                
            $this->setValidator('status_call_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__(""))+CustomerMeetingStatusCall::getStatusForI18nSelect())));                
        }
        if ($settings->hasAssistant())
        {    
            $this->setValidator('assistant_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No assistant"))+UserFunctionUtils::getUsersByFunctionForSelect2ForUser('ASSISTANT',$this->getUser()))));                
        }
        if ($settings->hasCampaign())
        {    
            $this->setValidator('campaign_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No campaign"))+CustomerMeetingCampaign::getCampaignSelect())));                
        }
        if ($settings->hasType())
        {    
            $this->setValidator('type_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No type"))+CustomerMeetingType::getTypeI18nForSelect())));                
        }
         if ($settings->hasPolluter())
        {    
            $this->setValidator('polluter_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerPolluterCompany::getPolluters2ForSelect())));                
        }  
        $actions=new mfArray();
        foreach (array('create_contract','created_at','in_at','telepro','sale1','sale2','email_sale1','email_sale2',
                       'sms_sale1','sms_sale2','state','assistant','sms_customer','email_customer','callcenter',
                       "campaign","type","products_by_default","generate_coordinates","polluter","remove_remarks","treated_at",
                       "status_callcenter","opc_at_equal_in_at","opc_at_time_to_range","in_at_time_to_range",
                       "contract_sale2","hold","unhold"
                      ) as $action)
        {    
            if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_multiple_'.$action))))     
            {        
                    $this->_actions->push($action);
            }        
        }              
        if ($this->getUser()->hasCredential(array(array('superadmin','superadmin_debug'))))
        {            
            $this->_actions->push('multiple_remove');
         //   $this->_actions->push("status_delete");
            $this->_actions->push("status_active");
        }        
        mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this, 'meetings.multiple.form.config'));   
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->_actions->toArray())));                
    }
    
     function getActions()
    {
        return $this->_actions;
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
    
     function getSelectionJson()
    {
        return json_encode($this['selection']->getValue());
    }
    
    function getSelection()
    {
        return new mfArray($this['selection']->getValue());
    }
    
    function hasAction($action)
    {
        return in_array($action,(array)$this['actions']->getValue());
    }
    
    function hasActions()
    {           
        return $this['actions']->getValue();
    }
    
    function getInAtHour()
    {               
        if ($this->getValue('in_at'))
            return date("H",strtotime($this['in_at']->getValue()));   
        return null;
    }
    
    function getInAtMinute()
    {
        if ($this->getValue('in_at'))
            return date("i",strtotime($this['in_at']->getValue()));       
        return null;
    }
    
    function getInAtDate()
    {       
        if ($this->getValue('in_at'))
            return date("Y-m-d",strtotime($this['in_at']->getValue()));      
        return null;
    }
    
    
    function getSelectionForUrl()
    {              
         return http_build_query(array('selection'=>(string)$this->getSelection()->implode()));
    }
    
    function hasActionInValidator($action)
    {
        return in_array($action,$this->actions->getOption('choices'));
    }
}