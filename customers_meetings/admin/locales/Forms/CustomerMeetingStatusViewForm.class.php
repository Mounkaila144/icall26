<?php


require_once dirname(__FILE__)."/CustomerMeetingStatusI18nForm.class.php";


class CustomerMeetingStatusViewForm extends mfForm {
      
   
    function configure()
    {
        $this->embedForm('status', new CustomerMeetingStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerMeetingStatusI18nForm($this->getDefault('status_i18n')));
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
