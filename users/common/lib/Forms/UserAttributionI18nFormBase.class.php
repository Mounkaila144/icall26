<?php



 class UserAttributionI18nBaseForm extends mfFormSite {
    
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
   
    function configure()
    {        
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),          
            "lang"=> new LanguagesExistsValidator(array(),'frontend',$this->getSite()), //   
            "value"=> new mfValidatorString(),                       
            ) 
        );      
    }
    
 
}


