<?php


require_once dirname(__FILE__)."/CustomerContractStatusI18nForm.class.php";


class CustomerContractStatusViewForm extends mfFormSite {
      
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
            
    function configure()
    {
        $this->embedForm('status', new CustomerContractStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerContractStatusI18nForm($this->getDefault('status_i18n'),$this->getSite()));
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
