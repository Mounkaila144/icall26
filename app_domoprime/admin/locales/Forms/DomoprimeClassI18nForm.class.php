<?php



 class DomoprimeClassI18nForm extends DomoprimeClassI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('class_id', new mfValidatorInteger());
    }
    
 
}


