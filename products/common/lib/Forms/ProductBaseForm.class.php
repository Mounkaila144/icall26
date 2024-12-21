<?php


class ProductBaseForm extends mfFormSite {
    
    function __construct($defaults = array(),$site = null) {
        parent::__construct($defaults, array(), $site);
    }
    
    function configure() {              
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                                                                                                                               
            "reference"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),                               
          //  "price"=>new mfValidatorI18nCurrency(array("required"=>false,'currency'=>ProductSettings::load($this->getSite())->get('default_currency','EUR'))),                                                           
            "meta_title"=>new mfValidatorProductTitle(array("max_length"=>"255")),
           // 'is_monthly'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),
          //  'is_billable'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),    
          //  'is_consomable'=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO','empty_value'=>'NO')),    
         //   "meta_description"=>new mfValidatorString(array("max_length"=>"255")),            
          //  "action_id"=>new mfValidatorChoice(array("required"=>false,"key"=>true,"choices"=>array(""=>"")+ProductAction::getActionsForSelect($this->getSite()))),                           
        ));                            
   
    }
    
}


