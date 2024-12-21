<?php

class mfValidatorComponent extends mfValidatorRegex
{
  const REGEX_COMPONENT_FORMAT = '~^      
      (/?|/\S+)                               # a /, nothing or a / with something
    $~ix';

 
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages); 
    $this->setOption('pattern', self::REGEX_COMPONENT_FORMAT);
  }

  
 
  
}
