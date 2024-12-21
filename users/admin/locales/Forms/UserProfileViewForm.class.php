<?php


require_once dirname(__FILE__)."/UserProfileI18nForm.class.php";


class UserProfileViewForm extends mfForm {
      
    protected $_profile=null;
            
    function __construct($defaults = array(), $options = array()) {
        parent::__construct($defaults, $options);
    }
    
    function setProfile(UserProfile $profile)
    {
        $this->_profile=$profile;
        if (!$this->hasDefaults())
        {                       
            $this->setDefault('functions',$this->getProfile()->getFunctions()->getKeys()->toArray());
            $this->setDefault('groups',$this->getProfile()->getGroups()->getKeys()->toArray());
        } 
        return $this;
    }
    
    function getProfile()
    {
        return $this->_profile;
    }
            
    function configure()
    {           
        $this->embedForm('profile', new UserProfileBaseForm($this->getDefault('profile')));
        $this->embedForm('profile_i18n', new UserProfileI18nForm($this->getDefault('profile_i18n')));
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
