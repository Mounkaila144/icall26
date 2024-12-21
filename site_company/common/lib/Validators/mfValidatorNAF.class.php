<?php

class mfValidatorNAF extends mfValidatorBase {
    
    protected function configure($options = array(), $messages = array()) {
        parent::configure($options, $messages);
        $this->setOption('empty_value', "");
    }
    
   protected function doIsValid($value)
   {
    $value= trim($value);
    if (!mfCountryNAF::getInstance()->isCodeExist($value))
      throw new mfValidatorError($this, $this->translateMessages('NAF number is invalid.'));    
    return $value;
    }
}
