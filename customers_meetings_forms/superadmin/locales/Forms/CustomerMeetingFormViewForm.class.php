<?php



require_once dirname(__FILE__)."/CustomerMeetingFormI18nForm.class.php";


class CustomerMeetingFormViewForm extends mfFormSite {
      
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
            
    function configure()
    {
        $this->embedForm('form', new CustomerMeetingFormBaseForm($this->getDefault('form')));
        $this->embedForm('form_i18n', new CustomerMeetingFormI18nForm($this->getDefault('form_i18n'),$this->getSite()));
        unset($this->form_i18n['id'], $this->form['id']);
    }

   
}

