<?php


class CustomerUnionNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('union_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('union', new CustomerUnionBaseForm($this->getDefault('union')));
        $this->embedForm('union_i18n', new CustomerUnionI18nBaseForm($this->getDefault('union_i18n')));
        unset($this->union_i18n['id'],$this->union['id']);
    }
}

