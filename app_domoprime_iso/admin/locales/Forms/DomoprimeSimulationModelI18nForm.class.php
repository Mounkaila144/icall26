<?php



 class DomoprimeSimulationModelI18nForm extends DomoprimeSimulationModelI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('model_id', new mfValidatorInteger());
    }
    
 
}


