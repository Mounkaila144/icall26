<?php


class CreateProfileForm extends mfForm {
   
   
   function configure() {   
       $this->setValidators(array(           
           'email'=>new mfValidatorEmail(),          
       ));
   }
    
   
   
}
    


