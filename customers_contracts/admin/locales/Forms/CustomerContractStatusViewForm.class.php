<?php


require_once dirname(__FILE__)."/CustomerContractStatusI18nForm.class.php";


class CustomerContractStatusViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('status', new CustomerContractStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerContractStatusI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }

}
