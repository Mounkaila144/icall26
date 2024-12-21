<?php


require_once dirname(__FILE__)."/CustomerMeetingTypeI18nForm.class.php";


class CustomerMeetingTypeViewForm extends mfForm {
      
   
    function configure()
    {
        $this->embedForm('type', new CustomerMeetingTypeBaseForm($this->getDefault('type')));
        $this->embedForm('type_i18n', new CustomerMeetingTypeI18nForm($this->getDefault('type_i18n')));
        unset($this->type_i18n['id'],$this->type['id']);
    }

  

}
