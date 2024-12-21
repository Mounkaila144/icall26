<?php


class CustomerMeetingStatusNewForm extends mfFormSite {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array(),$site=null)
    {       
        $this->language=$language;
        $defaults=array_merge(array('status_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array(),$site);
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('status', new CustomerMeetingStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new CustomerMeetingStatusI18nBaseForm($this->getDefault('status_i18n'),$this->getSite()));
        unset($this->status_i18n['id'],$this->status['id']);
    }
}

