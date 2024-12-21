<?php


class UserAttributionNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('attribution_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('attribution', new UserAttributionBaseForm($this->getDefault('attribution')));
        $this->embedForm('attribution_i18n', new UserAttributionI18nBaseForm($this->getDefault('attribution_i18n')));
        unset($this->attribution_i18n['id'],$this->attribution['id']);
    }
}

