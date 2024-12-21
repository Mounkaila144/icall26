<?php


class CustomerUserLoginMobileForm extends mfFormMobile {
    
    
    function configure()
    {         
        $this->setValidators(array(           
            'email'=>new mfValidatorEmail(),           
            'password'=>new mfValidatorString(),           
          //  'culture'=>new mfValidatorString(),            
          //  'promo'=>new mfValidatorString(array('required'=>false)),
        ));     
        $this->setOption('disabledCSRF',true);   
        $this->validatorSchema->setPostValidator(new CustomerUserGuardMobileValidator());
    }
    
    function getUser()
    {
        return $this->values['user'];                        
    }
    
   
    
    function getValues()
    {
        $values=array();
        $values['token']=$this->getToken();                      
        $values['status']="OK";
        return $values;
    }
}


