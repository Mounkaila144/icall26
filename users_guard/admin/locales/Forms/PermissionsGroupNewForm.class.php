<?php


class PermissionsGroupNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('group_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('group', new PermissionsGroupBaseForm($this->getDefault('group')));
        $this->embedForm('group_i18n', new PermissionsGroupI18nBaseForm($this->getDefault('group_i18n')));
        unset($this->group_i18n['id'],$this->group['id']);
    }
}

