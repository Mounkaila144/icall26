<?php



 class ProductItemSettingsForm extends mfFormSite {
 
    function __construct($site) {
        parent::__construct(array(),array(),$site);
    }
   
    function configure()
    {
        $this->setValidators(array(                     
           'calculation_by_ttc'=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
           'format_price'=>new mfValidatorString(),
            ) 
        );
    }
    
 
}


