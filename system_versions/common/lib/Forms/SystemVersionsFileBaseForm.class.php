<?php



 class SystemVersionsFileBaseForm extends mfFormSite {
 
    function __construct($site=null) {       
        parent::__construct(array(),array(),$site);
    }
  
    function configure()
    {
        $this->setValidators(array(  
            "id"=>new mfValidatorInteger(),
            "version"=>new mfValidatorString(array("min_length"=>1,"max_length"=>255)),
            "module"=>new mfValidatorString(array("min_length"=>1,"max_length"=>255)),
            "changes"=>new mfValidatorString(),
            ) 
        );                      
    }
    
    
   
 
}


