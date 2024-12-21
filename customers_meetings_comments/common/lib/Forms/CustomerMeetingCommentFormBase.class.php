<?php



 class CustomerMeetingCommentBaseForm extends mfForm {
    
   
    function configure()
    {        
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(),                    
            "comment"=> new mfValidatorString(array('max_length'=>512)),               
            ) 
        );      
    }
    
 
}


