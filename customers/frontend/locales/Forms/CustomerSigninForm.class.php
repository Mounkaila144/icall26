<?php


class CustomerSigninForm extends mfForm {
    
    
    function configure()
    {
        $settings=CustomerSettings::load();       
        $this->setValidators(array(           
            'email'=>new mfValidatorEmail(),           
            'password'=>new mfValidatorString(),                            
        ));      
    }
    
    function getUser()
    {
        $user=new CustomerUser(array('email'=>$this['email']->getValue(),'password'=>$this['password']->getValue()));           
        return $user;
    }
}


