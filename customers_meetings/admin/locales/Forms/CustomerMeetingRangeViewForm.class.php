<?php


require_once dirname(__FILE__)."/CustomerMeetingRangeI18nForm.class.php";


class CustomerMeetingRangeViewForm extends mfForm {
                 
    function configure()
    {
        $this->embedForm('range', new CustomerMeetingRangeBaseForm($this->getDefault('range')));
        $this->embedForm('range_i18n', new CustomerMeetingRangeI18nForm($this->getDefault('range_i18n')));
        unset($this->range_i18n['id'],$this->range['id']);
    }

}
