<?php


require_once dirname(__FILE__)."/CustomerContractInstallStatusI18nForm.class.php";


class CustomerContractInstallStatusViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('status', new CustomerContractInstallStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerContractInstallStatusI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }

}
