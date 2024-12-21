<?php


require_once dirname(__FILE__)."/DomoprimePreMeetingModelI18nForm.class.php";


class DomoprimePreMeetingModelViewForm extends mfForm {
      

    function configure()
    {
        $this->embedForm('model', new DomoprimePreMeetingModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimePreMeetingModelI18nForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }


}
