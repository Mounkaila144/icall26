<?php


class DomoprimeEnergyNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('energy_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults);
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('energy', new DomoprimeEnergyBaseForm($this->getDefault('energy')));
        $this->embedForm('energy_i18n', new DomoprimeEnergyI18nBaseForm($this->getDefault('energy_i18n')));
        unset($this->energy_i18n['id'],$this->energy['id']);
    }
}

