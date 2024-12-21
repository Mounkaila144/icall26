<?php


class CustomerContractStatusNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('status_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('status', new CustomerContractStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerContractStatusI18nBaseForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],$this->status['id']);
    }
}

