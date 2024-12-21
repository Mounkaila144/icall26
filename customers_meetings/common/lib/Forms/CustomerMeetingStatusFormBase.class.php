<?php

/*
 * Generated by SuperAdmin Generator date : 05/06/13 23:04:58
 */

 class CustomerMeetingStatusBaseForm extends mfForm {
 
   // All fields excepted foreign keys
   
    function configure()
    {
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                                    
            "name"=>new mfValidatorString(array("required"=>false,"max_length"=>64)),    
            "color"=>new mfValidatorString(array("required"=>false,"max_length"=>16)),    
            "icon"=>new mfValidatorFile(array("max_size"=>200 * 1024 ,"filename"=>"icon","required"=>false,"mime_types"=>"web_images",)),                                                                    
            ) 
        );
    }
    
 
}


