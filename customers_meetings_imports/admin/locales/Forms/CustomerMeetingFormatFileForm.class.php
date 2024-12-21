<?php

class CustomerMeetingFormatFileForm extends mfForm {

    

    function configure() { 
        $this->setValidators(array(  
            'name'=>new mfValidatorString(),
            'file'=>new mfValidatorFile(array('max_size'=>300 *1024,'mime_types'=>array( 'text/plain','text/csv', 'text/comma-separated-values','application/zip')))                                
                ));      
    }
    
    
    
}