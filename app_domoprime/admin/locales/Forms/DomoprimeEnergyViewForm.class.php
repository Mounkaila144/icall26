<?php


require_once dirname(__FILE__)."/DomoprimeEnergyI18nForm.class.php";


class DomoprimeEnergyViewForm extends mfForm {
      
   
    function configure()
    {
        $this->embedForm('energy', new DomoprimeEnergyBaseForm($this->getDefault('energy')));
        $this->embedForm('energy_i18n', new DomoprimeEnergyI18nForm($this->getDefault('energy_i18n')));
        unset($this->energy_i18n['id'],$this->energy['id']);
    }

  

}
