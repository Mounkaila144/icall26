<?php




class ServerServicesSettingsBaseForm extends mfFormSite{
    
    function __construct($defaults,$site=null) {       
        parent::__construct($defaults,array(),$site);
    }
    
    function configure()
    {
        $this->setValidators(array(                                    
               'master_host'=>new mfValidatorDomain(array('required'=>false)),
               'authorized_ips'=>new mfValidatorMultiple(new mfValidatorIp(),array('required'=>false,'separator'=>',')),
            ) 
        );                      
    }
}
