<?php


require_once dirname(__FILE__)."/CustomerContractAdminStatusI18nForm.class.php";


class CustomerContractAdminStatusViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('status', new CustomerContractAdminStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerContractAdminStatusI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }

}
