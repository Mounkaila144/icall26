<?php

class CustomerMeetingMutualCalculationForm extends mfForm {
    
    public function configure() {       
        
        $this->setValidators(array(  
           'date_calculation'=>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),        
        ));
    }
        
}