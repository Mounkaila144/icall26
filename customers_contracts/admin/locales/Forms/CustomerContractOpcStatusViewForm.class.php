<?php


require_once dirname(__FILE__)."/CustomerContractOpcStatusI18nForm.class.php";


class CustomerContractOpcStatusViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('status', new CustomerContractOpcStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerContractOpcStatusI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }

}
