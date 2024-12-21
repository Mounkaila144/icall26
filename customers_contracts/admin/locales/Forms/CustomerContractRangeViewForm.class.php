<?php


require_once dirname(__FILE__)."/CustomerContractRangeI18nForm.class.php";


class CustomerContractRangeViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('range', new CustomerContractRangeBaseForm($this->getDefault('range')));
        $this->embedForm('range_i18n', new CustomerContractRangeI18nForm($this->getDefault('range_i18n')));
        unset($this->range_i18n['id'],$this->range['id']);
    }

}
