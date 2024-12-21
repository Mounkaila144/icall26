<?php


class ProductItemViewForm extends ProductItemBaseForm {
    
    protected $item=null;
  
    function __construct(ProductItem $item,$defaults = array(),$user=null) {              
        $this->item=$item;
        parent::__construct($defaults,$user);        
    }
    
    function getProductItem()
    {
        return $this->item;
    }
   
    function configure()
    {
        parent::configure();
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_tva_view'))))
          $this->setValidator('tva_id', new mfValidatorChoice(array("key"=>true,"choices"=>TaxUtils::getTaxesForSelect())));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_sale_price_view'))))       
          $this->setValidator('sale_price', new mfValidatorI18nCurrency());                
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_purchasing_price_view'))))       
           $this->setValidator('purchasing_price', new mfValidatorI18nCurrency(array('required'=>false)));       
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_coefficient_view'))))       
           $this->setValidator('coefficient', new mfValidatorI18nPourcentage(array('required'=>false)));  
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_unit_view'))))       
           $this->setValidator('unit', new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>array(""=>"")+ProductItemUnit::getUnitsForSelect()->ksort()->toArray())));  
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_is_mandatory_view'))))       
           $this->setValidator('is_mandatory',new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_discount_price_view'))))       
           $this->setValidator('discount_price', new mfValidatorI18nCurrency(array('required'=>false)));    
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_multiple_view'))))       
           $this->setValidator('multiple', new mfValidatorI18nNumber(array('required'=>false)));        
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_is_default_view'))))       
           $this->setValidator('is_default', new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));
       foreach (array('discount_price','unit','coefficient','purchasing_price','input1','input2',
                      'input3','description','content','details','thickness','mark','multiple','input4','input5','input6','input7') as $field)
       {
          if ($this->hasValidator($field) && $this->getUser()->hasCredential(array(array('settings_product_item_'.$field.'_view_required'))))
              $this->$field->setOption('required',true);
       }     
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_linked_item'))))       
           $this->setValidator('linked_id', new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>ProductItem::getItemsExceptedForSelect($this->getProductItem())->unshift(array(''=>'')))));    
         if ($this->getUser()->hasCredential(array(array('superadmin','settings_product_item_is_multiple_view'))))       
           $this->setValidator('is_multiple',new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));
    }
    
    
}


