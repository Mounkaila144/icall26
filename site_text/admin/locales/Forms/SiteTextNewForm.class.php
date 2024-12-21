<?php


class  SiteTextNewForm extends  SiteTextBaseForm {
             
     function __construct($user,$defaults = array(), $options = array()) {
         $this->user=$user;
         parent::__construct($defaults, $options);
     }
     
     function getUser()
     {
         return $this->user;
     }
      function configure() {
            parent::configure();
            unset($this['id']);            
            if ($this->getUser()->hasCredential(array(array('superadmin','settings_texts_new_module')))) 
                $this->setValidator('module', new mfValidatorString(array()))  ;                
            if ($this->getUser()->hasCredential(array(array('superadmin','settings_texts_new_key'))))
                $this->setValidator('key', new mfValidatorString(array()))  ;                  
      }
     
}

