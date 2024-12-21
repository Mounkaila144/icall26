<?php


class SiteServicesViewDescriptionForm extends mfForm {
 
    
      function configure()
    {
        $this->setValidators(array(
            'description'=>new mfValidatorString(array('required'=>false)),
            'company'=>new mfValidatorString(array('required'=>false)),
            'id'=>new mfValidatorInteger(),
        ));
    }
}
