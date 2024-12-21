<?php

class DomoprimeQuotationItemForm  extends mfForm {
    
    function configure() {
       // var_dump(count($this->getDefault('items')));
        $this->setValidators(array(
            'product_id'=>new mfValidatorInteger(),
            'quantity'=>new mfValidatorI18nNumber(),
            'items'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('items'))),
        ));
    }
}

class DomoprimeQuotationViewForm extends mfForm {
         
    protected $quotation=null,$user=null;
    
   function __construct($quotation,$user,$defaults = array()) {
      
       parent::__construct($defaults);
   }
    
  
    
    function configure()
    {                       
       
    }
    
    
}

