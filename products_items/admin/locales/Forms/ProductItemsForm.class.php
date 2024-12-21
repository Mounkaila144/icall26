<?php


class ProductItemsForm extends ProductItemBaseForm {   
    static protected $units=null,$taxes=null;
   
    function configure()
    {
        parent::configure();
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_tva_view'))))
           $this->setValidator('tva_id', new mfValidatorChoice(array("key"=>true,"choices"=>ProductItemsForm::getTaxes())));
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_sale_price_view'))))       
           $this->setValidator('sale_price', new mfValidatorI18nCurrency(array('required'=>true)));                
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_purchasing_price_view'))))       
            $this->setValidator('purchasing_price', new mfValidatorI18nCurrency(array('required'=>false)));       
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_coefficient_view'))))       
            $this->setValidator('coefficient', new mfValidatorI18nPourcentage(array('required'=>false)));  
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_unit_view'))))       
            $this->setValidator('unit', new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>ProductItemsForm::getUnits())));  
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_is_mandatory_view'))))       
            $this->setValidator('is_mandatory',new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_discount_price_view'))))       
            $this->setValidator('discount_price', new mfValidatorI18nCurrency(array('required'=>false)));    
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_multiple_view'))))       
            $this->setValidator('multiple', new mfValidatorI18nNumber(array('required'=>false)));        
//        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_is_default_view'))))       
//            $this->setValidator('is_default', new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','settings_product_item_is_mandatory_view'))))       
            $this->setValidator('is_master',new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));    
           $this->setValidator('is_multiple',new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));
           
       //  $this->id->setOption('required',false);
    }
        
    static function getTaxes()
    {
        return self::$taxes=self::$taxes===null?TaxUtils::getTaxesForSelect():self::$taxes;
}
    
    static function getUnits()
    {
        return self::$units=self::$units===null?ProductItemUnit::getUnitsForSelect():self::$units;
    }
        
}
