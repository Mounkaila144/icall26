<?php


class DomoprimeSectorEnergyPriceForProductNewForm extends mfForm {
         
    
    
    function configure()
    {
         $this->setValidators(array(
            'price'=>new mfValidatorI18nCurrency(),
            'sector_id' => new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeSector::getSectorForSelect())),
            'energy_id' => new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeEnergy::getEnergyForI18nSelect())),
         ));
    }
}

