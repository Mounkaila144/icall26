<?php


require_once dirname(__FILE__)."/CustomerMeetingStatusCallI18nForm.class.php";


class CustomerMeetingStatusCallViewForm extends mfForm {
      
   
    function configure()
    {
        $this->embedForm('status', new CustomerMeetingStatusCallBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerMeetingStatusCallI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }

  

}
