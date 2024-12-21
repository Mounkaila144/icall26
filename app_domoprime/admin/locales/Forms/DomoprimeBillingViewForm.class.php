<?php

class DomoprimeBillingItemForm  extends mfForm {
    
    function configure() {
       // var_dump(count($this->getDefault('items')));
        $this->setValidators(array(
            'product_id'=>new mfValidatorInteger(),
            'quantity'=>new mfValidatorI18nNumber(),
            'items'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('items'))),
        ));
    }
}

class DomoprimeBillingViewForm extends mfForm {
         
    protected $billing=null,$user=null;
    
   function __construct($billing,$user,$defaults = array()) {
       $this->billing=$billing;
        $this->user=$user;
       parent::__construct($defaults);
   }
    
  
    
    function configure()
    {                       
       
    }
    
    
}

