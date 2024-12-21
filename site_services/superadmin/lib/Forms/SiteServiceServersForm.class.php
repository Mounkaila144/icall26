<?php



 class SiteServiceServersForm extends mfForm {
 
   
    function configure()
    {
        $this->setValidators(array(                
              'servers'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('servers')))
            ) 
        );
    }
    
    function getServers()
    {
        return new SiteServicesServerCollection($this->getValue('servers'));
    }
}


