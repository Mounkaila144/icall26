<?php

class CustomerMeetingStateAutoSaveForm extends mfForm {
    
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
         if ($field=='state_id')
            $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerMeetingStatus::getStatusForSelect())));
        elseif ($field=='status_call_id')
            $this->setValidator('value', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerMeetingStatusCall::getStatusCallForSelect())));                                      
       // elseif ($field=='sav_at_range_id')
       //     $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));
        }
    
    function configure()
    {        
         
        $this->setValidators(array(
            'id'=>new ObjectExistsValidator('CustomerMeeting',array('key'=>false)),
           'field'=>new mfValidatorChoice(array('choices'=>array('state_id','status_call_id')))                     
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

