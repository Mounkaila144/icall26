<?php


class DomoprimeOccupationNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('occupation_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('occupation', new DomoprimeOccupationBaseForm($this->getDefault('occupation')));
        $this->embedForm('occupation_i18n', new DomoprimeOccupationI18nBaseForm($this->getDefault('occupation_i18n')));
        unset($this->occupation_i18n['id'],$this->occupation['id']);
    }
}

