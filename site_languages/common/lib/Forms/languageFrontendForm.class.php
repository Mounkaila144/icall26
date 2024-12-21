<?php

class LanguageFrontendForm extends mfForm {         
    
     protected $site=null;
   
    function __construct($language='en',$site=null) 
    {
        $this->site=$site;
        parent::__construct(array('lang'=>$language));
    }
    
    protected function getSite()
    {
        return $this->site;
    }
    
    function configure()
    {     
       $this->setValidator('lang',new LanguagesExistsValidator(array(),'frontend',$this->getSite()));      
    }
    
    
}


