<?php

class CustomerMeetingStatesAutoSaveForm extends mfForm {
    
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
            $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerMeetingStatus::getStatusForSelect()->unshift(array("0"=>__("Not defined"))))));
        elseif ($field=='status_call_id')
            $this->setValidator('value', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerMeetingStatusCall::getStatusCallForSelect()->unshift(array("0"=>__("Not defined"))))));                                      
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

