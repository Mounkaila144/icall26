<?php


class ValidatorSignatures2 extends mfValidatorRegex {

    
   
const REGEX_SIGNATURE_FORMAT = '~^((-?(?:\d+|\d*\.\d+))\%,(-?(?:\d+|\d*\.\d+)),(-?(?:\d+|\d*\.\d+))(\|[0-9]+)\;?)+$~';

 
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages); 
    $this->setOption('pattern', self::REGEX_SIGNATURE_FORMAT);
  }
  
    
}
