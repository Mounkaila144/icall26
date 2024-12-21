<?php

class CustomerMeetingImportDirectForm extends mfForm {

    protected $user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user=$user;
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }

    function configure() {        
        $this->setValidators(array(              
            'file'=>new mfValidatorFile(array('max_size'=>5 * 1024 *1024,'mime_types'=>array( 'text/plain','text/csv','text/x-c', 'text/comma-separated-values', /* 'application/zip' */))),                                          
            ));             
    }
             
}
