<?php


require_once dirname(__FILE__)."/PartnerPolluterModelI18nForm.class.php";


class PartnerPolluterModelForPolluterForm extends mfForm {
      
    function __construct($defaults = array()) {
        parent::__construct($defaults);
    }
            
    function configure()
    {
        $this->embedForm('model', new PartnerPolluterModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new PartnerPolluterModelI18nForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }


}
