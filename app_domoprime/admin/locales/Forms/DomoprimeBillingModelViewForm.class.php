<?php


require_once dirname(__FILE__)."/DomoprimeBillingModelI18nForm.class.php";


class DomoprimeBillingModelViewForm extends mfForm {
      

    function configure()
    {
        $this->embedForm('model', new DomoprimeBillingModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimeBillingModelI18nForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }


}
