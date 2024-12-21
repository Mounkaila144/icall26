<?php


class CustomerMeetingRangeNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('range_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('range', new CustomerMeetingRangeBaseForm($this->getDefault('range')));
        $this->embedForm('range_i18n', new CustomerMeetingRangeI18nBaseForm($this->getDefault('range_i18n')));
        unset($this->range_i18n['id'],$this->range['id']);
    }
}

