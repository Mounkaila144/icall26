<?php



 class CustomerContractProductNewForm extends CustomerContractProductBaseForm {
        
    protected $user=null;
    
    function __construct($defaults = array(),$user=null) {        
        $this->user=$user;
        parent::__construct($defaults, array());        
    }
   
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {                        
        parent::configure();
        unset($this['id']);
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_products_is_one_shoot_new'))))
          $this->setValidator('is_one_shoot', new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_products_is_prorata_new'))))
        {        
          $this->setValidator('is_prorata', new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));
          $this->setValidator('started_at', new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)));
          //$this->setValidator('ended_at', new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')));
        }
     /*  if ($this->getUser()->hasCredential(array(array('superadmin','contract_products_tva_new'))))
          $this->setValidator('tva_id', new mfValidatorChoice(array("key"=>true,"choices"=>TaxUtils::getTaxesForSelect())));
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_products_quantity_new'))))
          $this->setValidator('quantity', new mfValidatorI18nNumber());
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_products_purchase_price_without_tax_new'))))
          $this->setValidator('purchase_price_without_tax', new mfValidatorI18nNumber());
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_products_saleprice_without_tax_new'))))
          $this->setValidator('sale_price_without_tax', new mfValidatorI18nNumber());  */
    }
    
 
}


