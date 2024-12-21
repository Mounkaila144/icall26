<?php



 class DomoprimeAssetModelI18nForm extends DomoprimeAssetModelI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('model_id', new mfValidatorInteger());
    }
    
 
}


