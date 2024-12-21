<?php

class DomoprimeEnergyAffectationForm extends mfForm {
    
     function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
   
    function configure() {
        $this->setValidator('current_energy_id', new mfValidatorInteger());
        $this->setValidator('energy_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("---"))+DomoprimeEnergy::getEnergyI18nListForSelect())));
    }
  

}
