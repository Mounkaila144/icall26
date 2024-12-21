<?php


class SendEmailModelForSalesForm extends mfForm {
    
    function configure()
    {
      $this->setValidators(array(
            'sale'=>new mfValidatorChoice(array('choices'=>array('EmailSale1','EmailSale2'))),   
            'model_id'=>new ObjectExistsValidator('UserModelEmailI18n',array('key'=>false)),
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
        if ($this['sale']->getValue()=='EmailSale1' && $this->getMeeting()->hasSale())
           return $this->getMeeting()->getSale();
        if ($this['sale']->getValue()=='EmailSale2' && $this->getMeeting()->hasSale2())
           return $this->getMeeting()->getSale2();
        return null;        
    }
}

