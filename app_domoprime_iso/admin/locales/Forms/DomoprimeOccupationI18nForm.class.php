<?php



 class DomoprimeOccupationI18nForm extends DomoprimeOccupationI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('occupation_id', new mfValidatorInteger());
    }
    
 
}


