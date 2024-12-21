<?php


class UserSecurityCodeValidator extends mfValidatorBase {
    
    
   public function configure($options = array(), $messages = array())
  {
    $this->addOption('code_field', 'code');    
    $this->setMessage('invalid', __('Code is invalid.'));
  }

  protected function doIsValid($values)
  {
    if (isset($values[$this->getOption('code_field')]))
    {            
      if ($code=UserSecurityCode::findByCode($values[$this->getOption('code_field')])) 
      {
          return array_merge($values, array('user' => $code->getUser()));
      }    
      throw new mfValidatorErrorSchema($this, array(
        $this->getOption('code_field') => new mfValidatorError($this, 'invalid'),
      )); 
    }
    // assume a required error has already been thrown, skip validation
    return $values;
  }
}
