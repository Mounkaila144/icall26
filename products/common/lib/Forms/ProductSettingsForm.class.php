<?php



 class ProductSettingsForm extends mfFormSite {
 
    function __construct($site) {
        parent::__construct(array(),array(),$site);
    }
   
    function configure()
    {
        $this->setValidators(array(
         
            
            'default_currency'=> new mfValidatorChoice(array("key"=>true,"choices"=>array('EUR'=>'EUR','USD'=>'USD'))),
            'default_products'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>array(""=>"")+ProductUtils::getActiveProductsForSelect($this->getSite()))),
            'default_contract_products'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>array(""=>"")+ProductUtils::getActiveProductsForSelect($this->getSite())))            
            ) 
        );
    }
    
 
}


