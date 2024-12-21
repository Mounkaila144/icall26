<?php


require_once dirname(__FILE__)."/DomoprimeSimulationModelI18nForm.class.php";


class DomoprimeSimulationModelViewForm extends mfForm {
      

    function configure()
    {
        $this->embedForm('model', new DomoprimeSimulationModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimeSimulationModelI18nForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }


}
