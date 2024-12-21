<?php


class ProductNewForm extends ProductBaseForm {
    
   
    protected $user=null;
    
    function __construct($defaults = array(),$user=null) {
        $this->user=$user;
        parent::__construct($defaults);
    }
   
    function getUser()
    {
        return $this->user;
    }
    
     function configure() {              
        parent::configure();
        unset($this['id']);  
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_action_new'))))
          $this->setValidator('action_id', new mfValidatorChoice(array("required"=>false,"key"=>true,"choices"=>array(0=>"")+ProductAction::getActionsForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_unit_new'))))
          $this->setValidator('unit', new mfValidatorString(array("max_length"=>"64","required"=>false)));
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_tva_new'))))
          $this->setValidator('tva_id', new mfValidatorChoice(array("key"=>true,"choices"=>TaxUtils::getTaxesForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_price_new'))))       
          $this->setValidator('price', new mfValidatorI18nNumber());                
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_purchasing_price_new'))))       
           $this->setValidator('purchasing_price', new mfValidatorI18nNumber(array('required'=>false)));       
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_prime_price_new'))))       
           $this->setValidator('prime_price', new mfValidatorI18nNumber(array('required'=>false)));     
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_is_monthly_new'))))       
           $this->setValidator( 'is_monthly',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));    
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_is_billable_new'))))       
           $this->setValidator( 'is_billable',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));    
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_is_consomable_new'))))       
           $this->setValidator( 'is_consomable',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));    
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_discount_price_new'))))       
           $this->setValidator( 'discount_price',new mfValidatorI18nNumber(array('required'=>false)));   
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_standard_price_new'))))       
           $this->setValidator( 'standard_price',new mfValidatorI18nNumber(array('required'=>false)));   
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_position_new'))))       
           $this->setValidator( 'position',new mfValidatorInteger(array('required'=>false,'min'=>0)));   
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_max_limit_new'))))       
             $this->setValidator( 'max_limit',new mfValidatorI18nNumber(array('required'=>false)));   
     }
    
}


