<?php

class mfValidatorPhoneString extends mfValidatorString {

  

  protected function doIsValid($value)
  {
    $clean=parent::doIsValid($value);
    if (strlen($clean) == 9)        
        $clean="0".$clean;
    return $clean;
  }  
    
}