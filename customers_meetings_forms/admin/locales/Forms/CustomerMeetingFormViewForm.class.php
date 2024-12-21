<?php



require_once dirname(__FILE__)."/CustomerMeetingFormI18nForm.class.php";


class CustomerMeetingFormViewForm extends mfForm {
      
    
            
    function configure()
    {
        $this->embedForm('form', new CustomerMeetingFormBaseForm($this->getDefault('form')));
        $this->embedForm('form_i18n', new CustomerMeetingFormI18nForm($this->getDefault('form_i18n')));
        unset($this->form_i18n['id'], $this->form['id']);
    }

   
}

