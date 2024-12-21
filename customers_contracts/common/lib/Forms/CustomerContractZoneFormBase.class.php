<?php


class CustomerContractZoneFormBase extends mfFormSite{
   
    
    function configure()
    {                        
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),
            "name"=>new mfValidatorString(),                  
            "max_contracts"=>new mfValidatorInteger(array('min'=>0)),              
            "postcodes"=> new mfValidatorMultiple(new mfValidatorInteger(array('min'=>1,'max'=>512))),                       
            ) 
        );      
    }
}
