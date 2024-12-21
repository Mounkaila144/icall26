<?php
/* */
class UserNewCheckEmailForm extends mfFormSite {
    
     function __construct($defaults = array(), $site = null) {
         parent::__construct($defaults, array(), $site);
     }
     function configure() {     
        $this->setValidators(array(
            'email'=>new mfValidatorEmail()
            ));
    }
    
    function isEmailExist()
    {
        $item=new User($this['email']->getValue(),'admin',$this->getSite());
        return $item->isLoaded();
    }
}