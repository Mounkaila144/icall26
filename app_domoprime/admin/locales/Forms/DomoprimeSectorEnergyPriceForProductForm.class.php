<?php


class DomoprimeSectorEnergyPriceForProductForm extends mfForm {
         
    
    
    function configure()
    {
         $this->setValidators(array(
            'id'=>new mfValidatorInteger(),
            'price'=>new mfValidatorI18nCurrency(),
            'sector_id' => new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeSector::getSectorForSelect())),
            'energy_id' => new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeEnergy::getEnergyForI18nSelect())),
         ));
    }
}

