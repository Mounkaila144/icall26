<?php



 class DomoprimeSimulationModelI18nBaseForm extends mfFormSite {
    
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
   
    function configure()
    {        
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),          
            "lang"=> new LanguagesExistsValidator(array(),'frontend',$this->getSite()), //   
            "value"=> new mfValidatorString(array('max_length'=>255)),                  
            "body"=> new mfValidatorString(array('max_length'=>32768)),       
            ) 
        );      
    }
    
 
}


