<?php


require_once dirname(__FILE__)."/CustomerContractTimeStatusI18nForm.class.php";


class CustomerContractTimeStatusViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('status', new CustomerContractTimeStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerContractTimeStatusI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }

}
