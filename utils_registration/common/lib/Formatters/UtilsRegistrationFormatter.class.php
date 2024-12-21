<?php

class UtilsRegistrationFormatter extends mfString {
    
     function render($tpl='{year){month}{registration}')
      {                          
          return new mfString(strtr($tpl,array('{year}'=>(string)$this->getRegistration()->get('year'),
                                          '{registration}'=>(string)$this->getRegistration()->get('registration'),
                                         '{month}'=>(string)$this->getRegistration()->get('month'),
                            )));
      }        
     
      
      function getRegistration()
      {
          return $this->value;
      }
}
