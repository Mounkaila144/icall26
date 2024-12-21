<?php


 class CustomerContractBaseForm extends mfFormSite {
 
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
             "opened_at"=>new mfValidatorI18nDate(array('date_format'=>"a")),
             "total_price_with_taxe"=>new mfValidatorI18nNumber(),
             "total_price_without_taxe"=>new mfValidatorI18nNumber(),            
             "payment_at"=>new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)),
             "opc_at"=>new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)),
             "apf_at"=>new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)),            
             "reference"=>new mfValidatorString(array("required"=>false))
            ) 
        );
    }
    
 
}


