<?php

 

 class CustomerUserForm extends CustomerUserBaseForm {
 
   
      function configure()
      {
          parent::configure();
          unset($this['id']);
      }
 
       function getValues()
      {
          $values=  parent::getValues();
          unset($values['avatar']);
          return $values;
      }
}


