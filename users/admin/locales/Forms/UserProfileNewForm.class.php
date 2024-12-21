<?php


class UserProfileNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('profile_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('profile', new UserProfileBaseForm($this->getDefault('profile')));
        $this->embedForm('profile_i18n', new UserProfileI18nBaseForm($this->getDefault('profile_i18n')));
        $this->addValidators(array(
            'groups'=>new mfValidatorChoice(array('key'=>true,'multiple'=>true,'choices'=>GroupUtils::getActiveGroupsForSelect()->toArray())),
            'functions'=>new mfValidatorChoice(array('key'=>true,'multiple'=>true,'choices'=>UserFunctionUtils::getActiveFunctionsForSelect()->toArray()))
        ));
        unset($this->profile_i18n['id'],$this->profile['id']);
    }
    
    function getGroups()
    {
        return $this['groups']->getArray();
    }
    
    function getFunctions()
    {
        return $this['functions']->getArray();
    }
    
}

