<?php

require_once dirname(__FILE__)."/CustomerMeetingFormatForm.class.php";

class CustomerMeetingViewFormatForm extends CustomerMeetingFormatForm {

    

    function configure() { 
       parent::configure();
       $this->setValidator('id', new mfValidatorInteger());
       unset($this['name']);
    }     
    
    
}