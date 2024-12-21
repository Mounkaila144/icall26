<?php


class CustomerUserAddressNewForm extends CustomerUserAddressBaseForm {

   function configure() {       
        if (!$this->hasDefault('country'))
        {
            $settings= CustomerSettings::load();
            $this->setDefault('country',$settings->get('default_country'));
        }    
        $this->setValidators(array(       
            'id'=>new mfValidatorInteger(),
            'alias'=>new mfValidatorName(),
            'address1'=>new mfValidatorString(),
            'address2'=>new mfValidatorString(array("required"=>false)),
            'postcode'=>new mfValidatorString(),
            'city'=>new mfValidatorString(),
            'country'=>new mfValidatorI18nChoiceCountry(), 
            'state'=>new mfValidatorI18nState($this->getDefault('country')),
        ));
        unset($this['id']);
    }
}
    


