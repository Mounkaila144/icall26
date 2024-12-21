<?php


class CustomerModifyForm extends mfForm {
         
    protected $user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user= $user;
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;        
    }
    
    function configure()
    {               
       $this->embedForm('customer', new CustomerBaseForm($this->getDefault('customer')));    
       $this->embedForm('address', new CustomerAddressBaseForm($this->getDefault('address')));         
       $this->defaults['address']['country']='FR';    
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_modify_company'))))
       {
          $this->customer->addValidator('company',new mfValidatorString(array("required"=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('contract_postcode_string_integer_validator'))))
       {
          $this->address->addValidator('postcode',new mfValidatorIntegerString(array("min_length"=>5,"max_length"=>5)));
       }
       unset($this->customer['id'],$this->address['id'],$this->address['country']);             
    }
       
}

