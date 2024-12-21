<?php


class ProductActionBaseForm extends mfFormSite {
    
    function __construct($defaults = array(),$site = null) {
        parent::__construct($defaults, array(), $site);
    }
    
    function configure() {              
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                    
            "title"=>new mfValidatorString(array("max_length"=>"255")),     
            "action"=>new mfValidatorComponent(array("max_length"=>"255")),                                                    
        ));                            
   
    }
    
}


