<?php



 class DomoprimeEnergyI18nForm extends DomoprimeEnergyI18nBaseForm {
    
    
   
    function configure()
    {
        parent::configure();
        $this->setValidator('energy_id', new mfValidatorInteger());
    }
    
 
}


