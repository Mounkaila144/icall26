<?php


class ProductViewForm extends ProductBaseForm {
    
   
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
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_action_modify'))))
          $this->setValidator('action_id', new mfValidatorChoice(array("required"=>false,"key"=>true,"choices"=>array(0=>"")+ProductAction::getActionsForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_unit_modify'))))
          $this->setValidator('unit', new mfValidatorString(array("max_length"=>"64","required"=>false)));
       if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_tva_modify'))))
          $this->setValidator('tva_id', new mfValidatorChoice(array("key"=>true,"choices"=>TaxUtils::getTaxesForSelect())));
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_price_modify'))))
          $this->setValidator('price', new mfValidatorI18nNumber());
         if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_purchasing_price_modify'))))       
           $this->setValidator('purchasing_price', new mfValidatorI18nNumber(array('required'=>false)));   
           if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_prime_price_modify'))))       
           $this->setValidator('prime_price', new mfValidatorI18nNumber(array('required'=>false)));   
            if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_is_monthly_modify'))))       
           $this->setValidator( 'is_monthly',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));    
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_is_billable_modify'))))       
           $this->setValidator( 'is_billable',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));    
         if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_is_consomable_modify'))))       
           $this->setValidator( 'is_consomable',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));    
           if ($this->getUser()->hasCredential(array(array('superadmin','settings_discount_price_modify'))))       
           $this->setValidator( 'discount_price',new mfValidatorI18nNumber(array('required'=>false)));   
           if ($this->getUser()->hasCredential(array(array('superadmin','settings_standard_price_modify'))))       
           $this->setValidator( 'standard_price',new mfValidatorI18nNumber(array('required'=>false)));   
           if ($this->getUser()->hasCredential(array(array('superadmin','settings_position_modify'))))       
           $this->setValidator( 'position',new mfValidatorInteger(array('required'=>false,'min'=>0)));   
           if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_max_limit_view'))))       
             $this->setValidator( 'max_limit',new mfValidatorI18nNumber(array('required'=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_description_view'))))       
             $this->setValidator( 'item_description',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_content_view'))))       
             $this->setValidator( 'item_content',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_details_view'))))       
             $this->setValidator( 'item_details',new mfValidatorString(array("max_length"=>"255","required"=>false)));    
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_input2_view'))))       
             $this->setValidator( 'item_input2',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_input3_view'))))       
             $this->setValidator( 'item_input3',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_input4_view'))))       
             $this->setValidator( 'item_input4',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_input5_view'))))       
             $this->setValidator( 'item_input5',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_input6_view'))))       
             $this->setValidator( 'item_input6',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_input7_view'))))       
             $this->setValidator( 'item_input7',new mfValidatorString(array("max_length"=>"255","required"=>false)));   
           //if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_thickness_view'))))       
             $this->setValidator( 'item_thickness',new mfValidatorString(array("max_length"=>"255","required"=>false)));    
     }
}


