<?php


require_once dirname(__FILE__)."/CustomerMeetingStatusI18nForm.class.php";


class CustomerMeetingStatusViewForm extends mfFormSite {
      
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
            
    function configure()
    {
        $this->embedForm('status', new CustomerMeetingStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerMeetingStatusI18nForm($this->getDefault('status_i18n'),$this->getSite()));
        unset($this->status_i18n['id'],
             // $this->product_download_i18n['file'],
              $this->status['id']);
    }

   /* function removeFileValidatator()
    {
        unset($this->product_download_i18n['file']);
        return $this;
    }*/

}
