<?php


require_once dirname(__FILE__)."/UserAttributionI18nForm.class.php";


class UserAttributionViewForm extends mfForm {
      
    function __construct($defaults = array()) {
        parent::__construct($defaults, array());
    }
            
    function configure()
    {
        $this->embedForm('attribution', new UserAttributionBaseForm($this->getDefault('attribution')));
        $this->embedForm('attribution_i18n', new UserAttributionI18nForm($this->getDefault('attribution_i18n')));
        unset($this->attribution_i18n['id'],$this->attribution['id']);
    }

  
}
