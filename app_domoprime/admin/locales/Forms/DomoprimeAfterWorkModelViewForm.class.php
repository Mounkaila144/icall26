<?php


require_once dirname(__FILE__)."/DomoprimeAfterWorkModelI18nForm.class.php";


class DomoprimeAfterWorkModelViewForm extends mfForm {
      

    function configure()
    {
        $this->embedForm('model', new DomoprimeAfterWorkModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimeAfterWorkModelI18nForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }


}
