<?php


require_once dirname(__FILE__)."/UserFunctionI18nForm.class.php";


class UserFunctionViewForm extends mfFormSite {
      
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
            
    function configure()
    {
        $this->embedForm('function', new UserFunctionBaseForm($this->getDefault('function')));
        $this->embedForm('function_i18n', new UserFunctionI18nForm($this->getDefault('function_i18n'),$this->getSite()));
        unset($this->function_i18n['id'],
             // $this->product_download_i18n['file'],
              $this->function['id']);
    }

  
}
