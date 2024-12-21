<?php


class SendEmailDefaultModelForSalesForm extends mfForm {
    
    protected $settings=null;
    
    function configure()
    {
      $this->settings=CustomerMeetingSettings::load();
      $this->setValidators(array(
            'sale'=>new mfValidatorChoice(array('choices'=>array('EmailSale1','EmailSale2'))),              
            'meeting_id'=>new ObjectExistsValidator('CustomerMeeting',array('key'=>false))
                ));
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function getModel()
    {
        return $this->getSettings()->getSalesModelEmail();        
    }
    
    function getMeeting()
    {
         return $this['meeting_id']->getValue();
    }
    
    
    function getSale()
    {        
        if ($this['sale']->getValue()=='EmailSale1' && $this->getMeeting()->hasSale())
           return $this->getMeeting()->getSale();
        if ($this['sale']->getValue()=='EmailSale2' && $this->getMeeting()->hasSale2())
           return $this->getMeeting()->getSale2();
        return null;        
    }
}

