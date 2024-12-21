<?php

 

 class MyAccountForm extends CustomerUserBaseForm {
 
   
      function configure()
      {
          parent::configure();
          $this->addValidators(array(
             'password' => new mfValidatorString(),
             'repassword' => new mfValidatorString()
          ));          
          unset($this['id']);          
          if (!$this->getDefault('password'))          
          {
             $this->password->setOption('required',false); 
             $this->repassword->setOption('required',false);
          }
          $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
      }
 
      function getValues()
      {
          $values=  parent::getValues();
          unset($values['avatar']);
          if (!$values['password'])
              unset($values['password']);
          return $values;
      }
}


