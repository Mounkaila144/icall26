<?php


require_once dirname(__FILE__)."/UserAttributionI18nForm.class.php";


class UserAttributionViewForm extends mfFormSite {
      
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
            
    function configure()
    {
        $this->embedForm('attribution', new UserAttributionBaseForm($this->getDefault('attribution')));
        $this->embedForm('attribution_i18n', new UserAttributionI18nForm($this->getDefault('attribution_i18n'),$this->getSite()));
        unset($this->attribution_i18n['id'],
             // $this->product_download_i18n['file'],
              $this->attribution['id']);
    }

  
}
