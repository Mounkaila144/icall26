<?php


class SiteServicesSettingsBaseForm extends mfFormSite{
    
    function __construct($site=null) {       
        parent::__construct(array(),array(),$site);
    }
    
    function configure()
    {
        $this->setValidators(array(                       
              //'server_id'=>new mfValidatorChoice(array("key"=>true,'required'=>true,"choices"=>array(0=>"")+SiteServices::getServersForSelect($this->getSite()))),
            //   'master_host'=>new mfValidatorDomain(),
            ) 
        );                      
    }
}
