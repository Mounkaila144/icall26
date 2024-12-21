<?php


require_once dirname(__FILE__)."/DomoprimeAssetModelI18nForm.class.php";


class DomoprimeAssetModelViewForm extends mfForm {
      

    function configure()
    {
        $this->embedForm('model', new DomoprimeAssetModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimeAssetModelI18nForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }


}
