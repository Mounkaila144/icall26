<?php


class DomoprimeTypeLayerNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('type_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('type', new DomoprimeTypeLayerBaseForm($this->getDefault('type')));
        $this->embedForm('type_i18n', new DomoprimeTypeLayerI18nBaseForm($this->getDefault('type_i18n')));
        unset($this->type_i18n['id'],$this->type['id']);
    }
}

