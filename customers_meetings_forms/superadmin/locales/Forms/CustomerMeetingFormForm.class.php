<?php

require_once dirname(__FILE__)."/CustomerMeetingFormFieldForm.class.php";


 class CustomerMeetingFormForm extends mfForm {
    
    
   
    function configure()
    {
        if (!$this->hasDefault('count'))
            $this->setDefault('count',1);
        $this->setValidators(array(
                'count'=>new mfValidatorInteger(),                
               ));               
       $this->createEmbedFormForEach('fields','CustomerMeetingFormFieldForm', $this->getDefault('count'));   
       
    }
    
    function  getWidgetForChoices()
    {
        return CustomerMeetingFormFieldForm::getWidgetForChoices();
    }
   
}


