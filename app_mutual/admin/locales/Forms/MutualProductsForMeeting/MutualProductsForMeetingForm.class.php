<?php


class MutualProductsForMeetingForm extends mfForm {
    
    function __construct($defaults = array()) { 
        parent::__construct($defaults);
    }
    
    public function configure() {       
        
        $this->setValidators(array(                 
           'product_id'=>new mfValidatorInteger(),
           'sale_price_with_tax'=>new mfValidatorI18nCurrency(),          
        ));
    }
    
}