<?php

class MarketingLeadsWpFormsLeadsImportSettingsBaseForm extends mfFormSite {
 
    function __construct($site=null) {       
        parent::__construct(array(),array(),$site);
    }
  
    function configure()
    {
        $this->setValidators(array(            
//                "max_leads_to_fetch"=>new mfValidatorInteger(array()),
            ) 
        );                      
    }
 
}


