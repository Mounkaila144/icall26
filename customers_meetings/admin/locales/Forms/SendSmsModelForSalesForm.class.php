<?php


class SendSmsModelForSalesForm extends mfForm {
    
    function configure()
    {
      $this->setValidators(array(
            'sale'=>new mfValidatorChoice(array('choices'=>array('SmsSale1','SmsSale2'))),   
            'model_id'=>new ObjectExistsValidator('UserModelSmsI18n',array('key'=>false)),
            'meeting_id'=>new ObjectExistsValidator('CustomerMeeting',array('key'=>false))
                ));
    }
    
    function getModelI18n()
    {
        return $this['model_id']->getValue();
    }
    
    function getMeeting()
    {
         return $this['meeting_id']->getValue();
    }
    
    
    function getSale()
    {        
        if ($this['sale']->getValue()=='SmsSale1' && $this->getMeeting()->hasSale())
           return $this->getMeeting()->getSale();
        if ($this['sale']->getValue()=='SmsSale2' && $this->getMeeting()->hasSale2())
           return $this->getMeeting()->getSale2();
        return null;        
    }
}

