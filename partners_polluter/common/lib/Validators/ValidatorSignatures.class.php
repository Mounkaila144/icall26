<?php


class ValidatorSignatures extends mfValidatorRegex {

  
const REGEX_SIGNATURE_FORMAT = '~^      
      (([0-9]+,[0-9]+,[0-9]+,[0-9]+)(\|[0-9]+)\;?)+
    $~ix';

 
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages); 
    $this->setOption('pattern', self::REGEX_SIGNATURE_FORMAT);
  }
  
    
}
