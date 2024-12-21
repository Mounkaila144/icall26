<?php

require_once dirname(__FILE__).'/MutualProductsForMeetingForm.class.php';

class NewMutualProductForMeetingForm extends mfForm {
    
    function __construct(CustomerMeeting $meeting,$defaults = array()) {    
        $this->meeting = $meeting;
        parent::__construct($defaults);
    }
    
    function getMeeting()
    {
        return $this->meeting;
    }
    
    public function configure() {       
 
        $this->mutuals=MutualPartner::getSelectedAndUnselectedProductsWithMutual($this->getMeeting()); 
        $this->embedFormForEach('collection',new MutualProductsForMeetingForm(),count($this->getDefault('collection')));
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback'=>array($this, 'checkProductsId'))));
    }
    
    function getMutuals()
    {
        return $this->mutuals;
    }
    
    function getSelectedMutuals()
    {
        $values = array();
        
        foreach($this->mutuals as $mutual)
        {
            if($mutual->hasSelectedProducts())
                $values[$mutual->get('id')] = $mutual;
        }
        return $values;
    }
    
    function getValuesAsCollection()
    {
        $values = $this->getValue("collection");
        $products_meeting = new CustomerMeetingMutualProductCollection();
        foreach($values as $meeting_product)
        {
            $product = new CustomerMeetingMutualProduct($meeting_product);
            $product->set("meeting_id", $this->getMeeting());
            $products_meeting[$product->get('product_id')] = $product;
        }
        return $products_meeting;
    }
    
    function getDefaultsAsCollection()
    {
        $values = $this->getDefault("collection");
        $products_meeting = new CustomerMeetingMutualProductCollection();
        foreach($values as $meeting_product)
        {
            $product = new CustomerMeetingMutualProduct($meeting_product);
            $product->set("meeting_id", $this->getMeeting());
            $products_meeting[] = $product;
        }
        return $products_meeting;
    }
    
    function checkProductsId($validator,$values)
    {
        $site = null;
        $products = new mfArray();
        $products_exist = new mfArray();
        
        foreach ($values['collection'] as $key => $value) {
            $products[$value['product_id'] ] = $key;
        }
        
        $db = mfSiteDatabase::getInstance();
        $db->setQuery(" SELECT id FROM ".MutualProduct::getTable().
                      " WHERE ".MutualProduct::getTableField('id')." IN ('".$products->getKeys()->implode("','")."')".
                      ";")
           ->makeSiteSqlQuery($site);
        
        while($row=$db->fetchArray())
        {
            $products_exist[] = $row["id"];
        }
        
        foreach($products as $key=>$value)
        {
            if(!in_array($key, $products_exist->toArray()))
                unset($values['collection'][$value]);
        }
        return $values;
    }
    
    function getMutualsToJson()
    {
        return $this->getMutuals()->toJsonForForm();
    }
}