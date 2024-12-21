<?php


require_once dirname(__FILE__)."/UserFunctionI18nForm.class.php";


class UserFunctionViewForm extends mfForm {
      
    function __construct($defaults = array()) {
        parent::__construct($defaults, array());
    }
            
    function configure()
    {
        $this->embedForm('function', new UserFunctionBaseForm($this->getDefault('function')));
        $this->embedForm('function_i18n', new UserFunctionI18nForm($this->getDefault('function_i18n')));
        unset($this->function_i18n['id'],$this->function['id']);
    }

  
}
