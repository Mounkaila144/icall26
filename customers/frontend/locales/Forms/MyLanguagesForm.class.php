<?php

 require_once dirname(__FILE__)."/CustomerUserForm.class.php";


 class MyLanguagesForm extends mfForm {
 
     protected $user=null;
     
     function __construct($user,$defaults=array()) {        
        $this->user=$user;        
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }
       
    
    function configure()    
    {        
       if (!$this->hasDefaults())
            $this->setDefault('languages',$this->getUser()->getGuardUser()->getLanguagesById());
       $this->setValidators(array(
           'languages'=>new mfValidatorChoice(array('multiple'=>true,'key'=>true,'choices'=>LanguageUtils::getLanguagesFrontend()))
       ));              
    }
    
    function getLanguages()
    {
        return $this->languages->getOption('choices');
    }
    
    function hasLanguage($language_id)
    {
        return in_array($language_id,$this->getDefault('languages'));
    }
    
}


