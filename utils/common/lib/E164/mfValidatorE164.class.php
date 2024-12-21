<?php

class mfValidatorE164 extends mfValidatorBase {
    
    
  
    protected function configure() {       
        $this->addOption('country',"");   
    }
    
    protected function doIsValid($NumberStr){
        $phoneUtil = PhoneNumberUtil::getInstance();
        try 
        {                 
            $number = $phoneUtil->parse($NumberStr, $this->getOption('country','CH'));              
        }
        catch (NumberParseException $e)
        {
            throw new mfValidatorError($this,'invalid',array('value' => $NumberStr));        
        }
        if (! $phoneUtil->isValidNumber($number))
            throw new mfValidatorError($this,'invalid',array('value' => $number));                                       
        return $number;
    }
    
    function getIndicatifs()
    {        
        return mfPhoneInfo::getInstance()->setClass('mfPhoneIndicatif')->getPhoneIndicatifsByCountry()->asortByCode();
    }
}