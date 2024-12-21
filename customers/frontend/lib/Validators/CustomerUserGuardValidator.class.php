<?php

class CustomerUserGuardValidator extends mfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('username_field', 'username');
    $this->addOption('password_field', 'password');
    $this->setMessage('invalid', __('The email and/or password is invalid.'));
  }

  protected function doIsValid($values)
  {      
    if (isset($values[$this->getOption('username_field')]) && isset($values[$this->getOption('password_field')]))
    {
      if ($values[$this->getOption('username_field')]==''||$values[$this->getOption('password_field')]=='')
          return $values;
      $username = $values[$this->getOption('username_field')];
      $password = md5($values[$this->getOption('password_field')]);     
      if ($user=CustomerUserUtils::findByEmailOrUsernameAndPassword($username, $password)) 
      {                
          return array_merge($values, array('user' => $user));
      }         
      throw new mfValidatorErrorSchema($this, array(
        $this->getOption('username_field') => new mfValidatorError($this, 'invalid'),
      ));
    }
    // assume a required error has already been thrown, skip validation
    return $values;
  }
}
