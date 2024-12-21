<?php

class ProfileReAffectForm extends mfForm {

    protected $profile=null,$profile_from=null;
    
    function __construct(UserProfile $user_profile,$defaults = array(), $options = array()) {
        $this->profile_from=$user_profile;
        parent::__construct($defaults, $options);
    }
    
    function getProfileFrom()
    {
        return $this->profile_from;
    }
    
   function configure() { 
         $this->setValidators(array(            
             'profile_id'=>new mfValidatorChoice(array('key'=>true,'choices'=> UserProfileUtils::getProfilesExceptedForSelect($this->getProfileFrom())->toArray()))
         ));
    }

    function getProfile()
    {
        if ($this->profile===null)
        {
            $this->profile=new UserProfile($this['profile_id']->getValue());
        }   
        return $this->profile;
    }
}