<?php

class moduleSitesForm extends mfForm {
            
    function configure()
    {      
        $this->setValidators(array(            
            "module"=>new moduleManagerAdminExistsValidator(),
            "sites"=>new siteCollectionExistValidator(array(),count($this->getDefault('sites')))
        ));  
    }
}
