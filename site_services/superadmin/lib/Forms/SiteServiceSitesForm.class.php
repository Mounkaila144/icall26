<?php



 class SiteServiceSitesForm extends mfForm {
 
   
    function configure()
    {
        $this->setValidators(array(                
              'sites'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('sites')))
            ) 
        );
    }
    
  function getSites()
    {
        return new SiteServicesSiteCollection($this->getValue('sites'));
    }
}


