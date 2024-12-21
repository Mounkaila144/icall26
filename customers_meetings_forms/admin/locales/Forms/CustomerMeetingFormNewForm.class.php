<?php


class CustomerMeetingFormNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('form_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('form', new CustomerMeetingFormBaseForm($this->getDefault('form')));
        $this->embedForm('form_i18n', new CustomerMeetingFormI18nBaseForm($this->getDefault('form_i18n')));
        unset($this->form_i18n['id'],$this->form['id']);
    }
}

