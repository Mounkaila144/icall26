<?php


class DomoprimeZoneFromPostcodeForm extends mfForm {
         
    
    
    function configure()
    {
        $this->setValidators(array(
           'postcode'=>new mfValidatorInteger() 
        ));
    }
    
    function getZone()
    {        
        $postcode=$this['postcode']->getValue();
        if (strlen($postcode)==4 )
            $postcode="0".$postcode;             
        return new DomoprimeZone(array('code'=>intval($postcode / 1000)));
    }
}

