<?php

require_once __DIR__."/CustomerMeetingFormatForm.class.php";

class CustomerMeetingFormatDirectForm extends CustomerMeetingFormatForm {

     
    function configure() { 
        parent::configure();
        unset($this['name']);        
    }     
    
    
    
}