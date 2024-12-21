<?php


class DomoprimeClassNewForm extends mfForm {
         
    protected $language=null,$user=null;
    
    function __construct($user,$language='en',$defaults=array())
    {       
        $this->user=$user;
        $this->language=$language;
        $defaults=array_merge(array('class_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults);
    }
           
    function getUser()
    {
        return $this->user;        
    }
    
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('class', new DomoprimeClassBaseForm($this->getDefault('class')));
        $this->embedForm('class_i18n', new DomoprimeClassI18nBaseForm($this->getDefault('class_i18n')));
        unset($this->class_i18n['id'],$this->class['id']);
        if ($this->getUser()->hasCredential(array(array('app_domoprime_class_new_no_multiple_floor_top_wall'))))        
            unset($this->class['multiple'],$this->class['multiple_floor'],$this->class['multiple_top'],$this->class['multiple_wall']);   
    }
}

