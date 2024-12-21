<?php


class UserFunctionNewForm extends mfFormSite {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array(),$site=null)
    {       
        $this->language=$language;
        $defaults=array_merge(array('function_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array(),$site);
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('function', new UserFunctionBaseForm($this->getDefault('function')));
        $this->embedForm('function_i18n', new UserFunctionI18nBaseForm($this->getDefault('function_i18n'),$this->getSite()));
        unset($this->function_i18n['id'],$this->function['id']);
    }
}

