<?php


class DomoprimeBillingModelNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('model_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('model', new DomoprimeBillingModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimeBillingModelI18nBaseForm($this->getDefault('model_i18n')));
        unset($this->model_i18n['id'],$this->model['id']);
    }
}

