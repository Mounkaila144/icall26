<?php

class CustomerMeetingSalesForm extends mfForm {
    
    protected $user=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {
        $this->setValidators(array(
             'sale'=>new mfValidatorChoice(array('choices'=>array('SALE1','SALE2'))),
             'meeting_id'=>new ObjectExistsValidator('CustomerMeeting',array('key'=>false)),
             'sale_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser()))),
        ));
    }
    
    function getMeeting()
    {
        return $this['meeting_id']->getValue();
    }
    
    function isSale1()
    {
        return ($this['sale']->getValue()=='SALE1');
    }
    
    function getSaleField()
    {
        return $this->isSale1()?'sales_id':'sale2_id';
    }
}