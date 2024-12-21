<?php

class MarketingLeadsWpFormsStatusBaseForm extends mfForm {
 
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


