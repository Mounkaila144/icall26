<?php



 class DomoprimePreMeetingModelI18nForm extends DomoprimePreMeetingModelI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('model_id', new mfValidatorInteger());
    }
    
 
}


