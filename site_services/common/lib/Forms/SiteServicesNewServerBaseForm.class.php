<?php


class SiteServicesNewServerBaseForm extends mfFormSite {
    
     
    function __construct($defaults=array(),$site=null) {       
        parent::__construct($defaults,array(),$site);
    }
    
    function configure()
    {      
        $this->setValidators(array(     
             "id"=>new mfValidatorInteger(),
             "host"=>new mfValidatorString(array('max_length'=>255)),
             "name"=>new mfValidatorString(array('max_length'=>1024)),
             "ip"=>new mfValidatorString(array('max_length'=>64)),
             "login_service"=>new mfValidatorString(array('max_length'=>64)),
             "password"=>new mfValidatorString(array('max_length'=>64)),
            ) 
        );                      
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new SiteServicesSettings():$this->settings;
    }
}
