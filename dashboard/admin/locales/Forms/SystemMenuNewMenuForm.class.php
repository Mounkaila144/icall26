<?php


class SystemMenuNewMenuForm extends mfForm {
    
      protected $_node=null,$language=null;
    
    function __construct($language)
    {
       $this->language=$language;           
       parent::__construct();      
    }
    function configure()
    {
        $this->embedForm('menu', new SystemMenuBaseForm($this->getDefault('menu')));
        $this->embedForm('menu_i18n', new SystemMenuI18nBaseForm($this->getDefault('menu_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);       
    }
   
  function getLanguage()
    {
        return $this->language;
    }
    
   
}

