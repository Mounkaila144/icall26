<?php



 class DomoprimeTypeLayerI18nForm extends DomoprimeTypeLayerI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('type_id', new mfValidatorInteger());
    }
    
 
}


