<?php
/* */
class UserNewCheckEmailForm extends mfForm {
    
    
     function configure() {     
        $this->setValidators(array(
            'email'=>new mfValidatorEmail()
            ));
    }
    
    function isEmailExist()
    {
        $item=new User($this['email']->getValue(),'admin');
        return $item->isLoaded();
    }
}