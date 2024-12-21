<?php

class DomoprimeEnergyAffectationForm extends mfForm {
    
    
    function configure() {
        $this->setValidator('current_energy_id', new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeEnergy::getEnergyI18nListForSelect())));
        $this->setValidator('energy_id',new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeEnergy::getEnergyI18nListForSelect())));
    }
  
    
    function getCurrentEnergy()
    {
        return new DomoprimeEnergy($this['current_energy_id']->getValue());
    }
    
    function getEnergy()
    {
        return new DomoprimeEnergy($this['energy_id']->getValue());
    }
    
    function isSameEnergy()
    {
        return $this->getCurrentEnergy()->get('id')==$this->getEnergy()->get('id');
    }

}
