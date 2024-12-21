<?php


class CustomerModifyForm extends mfFormSite {
         
    function __construct($defaults = array(),$site = null) {
         parent::__construct($defaults,array(), $site);
     }
    
    function configure()
    {               
       $this->embedForm('customer', new CustomerBaseForm($this->getDefault('customer')));    
       $this->embedForm('address', new CustomerAddressBaseForm($this->getDefault('address')));         
       $this->defaults['address']['country']='FR';    
       unset($this->customer['id'],$this->address['id'],$this->address['country']);             
    }
       
}

