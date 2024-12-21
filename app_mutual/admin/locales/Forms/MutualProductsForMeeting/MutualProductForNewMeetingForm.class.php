<?php

require_once dirname(__FILE__).'/MutualProductsForMeetingForm.class.php';

class MutualProductForNewMeetingForm extends mfFormSite {
    
    function __construct($defaults = array()) {
        parent::__construct($defaults);
    }
    
    public function configure() {       
        $this->mutuals=MutualPartner::getProductsWithMutualNoMeeting();     
        $this->embedFormForEach('collection',new MutualProductsForMeetingForm(),count($this->getDefault('collection')));
        $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback'=>array($this, 'checkProductsId'))));
    }
    
    function getMutuals()
    {
        return $this->mutuals;
    }
    
    function getProductsForMutual(MutualPartner $mutual)
    {
        return $this->mutuals[$mutual->get('id')]->getProducts();
    }
    
    // A simplifier
    function getCollection($values=array(),CustomerMeeting $meeting)
    {
        if(isset($values['collection']))
            $values = $values['collection'];
        
        $products_meeting = new CustomerMeetingMutualProductCollection();
        
        foreach($values as $value)
        {
            $mutual_meeting = new CustomerMeetingMutualProduct($value);
            $mutual_meeting->set('meeting_id',$meeting);
            $products_meeting[] = $mutual_meeting;
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
}