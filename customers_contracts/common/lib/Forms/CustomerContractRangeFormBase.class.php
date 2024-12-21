<?php



 class CustomerContractRangeBaseForm extends mfForm {
 
   // All fields excepted foreign keys
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "name"=>new mfValidatorString(array("required"=>false,"max_length"=>64)),    
            "from"=>new mfValidatorTime(array('time_format'=>'/^(?P<hour>[0-1]?[0-9]|2?[0-3]):(?P<minute>[0-5]?[0-9])$/','time_output'=>'H:i:s'),array('bad_format'=> __('"{value}" does not match the time format.'))),    
            "to"=>new mfValidatorTime(array('time_format'=>'/^(?P<hour>[0-1]?[0-9]|2?[0-3]):(?P<minute>[0-5]?[0-9])$/','time_output'=>'H:i:s'),array('bad_format'=> __('"{value}" does not match the time format.'))),    
            "color"=>new mfValidatorColor(array("required"=>false,"max_length"=>16)),    
            ) 
        );
    }
    
 
}


