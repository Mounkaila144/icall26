<?php

class AutoSaveMeetingForm extends mfForm {
    
    protected $user=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
     
    function setValidatorForField($field)
    {  
         if ($field=='financial_partner_id')
            $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+PartnerUtils::getPartnerForSelect())));
        elseif ($field=='partner_layer_id')
            $this->setValidator('value', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerLayerCompany::getLayersForSelect())));                                      
       // elseif ($field=='sav_at_range_id')
       //     $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));
        elseif ($field=='state_id')
            $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerMeetingStatusUtils::getStatusForI18nSelect())));
       // elseif ($field=='time_state_id')
      //     $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractTimeStatus::getStatusForI18nSelect())));
         elseif ($field=='polluter_id')
           $this->setValidator('value', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+PartnerPolluterCompany::getPolluters2ForSelect())));   
       //   elseif ($field=='opc_status_id')
       //     $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerMeetingOpcStatus::getStatusForI18nSelect())));
      //     elseif ($field=='admin_status_id')
       //      $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractAdminStatus::getStatusForI18nSelect())));
    }
    
    function configure()
    {
        $this->setValidators(array(
            'id'=>new ObjectExistsValidator('CustomerMeeting',array('key'=>false)),
            'field'=>new mfValidatorChoice(array('choices'=>array('financial_partner_id','partner_layer_id','sav_at_range_id','state_id','time_state_id','polluter_id','opc_status_id','admin_status_id')))            
        ));
        $this->setValidatorForField($this->getDefault('field'));
    }
    
    function getFieldI18n()
    {
        return __("field_".$this['field']->getValue());
    }
    
    function getMeeting()
    {
        return $this['id']->getValue();
    }
        
    function getValue()
    {
        return $this['value']->getValue();
    }                
    
    function process()
    {        
        $this->getMeeting()->set($this['field']->getValue(),$this->getValue());
        $this->getMeeting()->setComments($this->getUser());   
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getMeeting(), 'meeting.field.autosave.before.save',array('action'=>'autosave'))); 
        $this->getMeeting()->save();                
        return $this;
    }
}

