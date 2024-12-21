<?php



 class SystemMenuBaseForm extends mfForm {
 
   // All fields excepted foreign keys
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "name"=>new mfValidatorString(array("required"=>false,"max_length"=>64)),    
            "module"=>new mfValidatorString(array("required"=>false)),
            "parent_id"=>new ObjectExistsValidator('SystemMenu',array("required"=>false))  
            ) 
        );
    }
    
 
}


