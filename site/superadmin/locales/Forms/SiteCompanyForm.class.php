<?php

class SiteCompanyForm extends mfForm {

    function configure() { 
                        
        $this->setValidators(array(    
            'site_id'=>new mfValidatorInteger(),
            'site_company' => new mfValidatorString(array('required'=>false)),            
        ));
    }
}