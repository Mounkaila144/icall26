<?php


require_once dirname(__FILE__)."/CustomerMeetingStatusLeadI18nForm.class.php";


class CustomerMeetingStatusLeadViewForm extends mfForm {
      
   
    function configure()
    {
        $this->embedForm('status', new CustomerMeetingStatusLeadBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerMeetingStatusLeadI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }

  

}
