<?php


require_once dirname(__FILE__)."/DomoprimeQuotationModelI18nForm.class.php";


class DomoprimeQuotationModelViewForm extends mfForm {
      

    function configure()
    {
        $this->embedForm('model', new DomoprimeQuotationModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimeQuotationModelI18nForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }


}
