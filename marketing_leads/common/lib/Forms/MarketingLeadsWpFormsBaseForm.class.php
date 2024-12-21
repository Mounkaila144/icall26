<?php


class MarketingLeadsWpFormsBaseForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'id'=> new mfValidatorInteger(),
            'id_wp'=> new mfValidatorInteger(),
            'firstname' => new mfValidatorName(), 
            'lastname' => new mfValidatorName(), 
            'phone' => new mfValidatorPhoneString(), 
            'email' => new mfValidatorEmail(), 
            'address' => new mfValidatorAddress(), 
            'postcode' => new mfValidatorInteger(), 
//            'country' => new mfValidatorChoiceCountry(), 
            'city' => new mfValidatorString(), 
            'owner' => new mfValidatorChoice(array('choices'=>array('tenant'=>__('tenant'),'owner'=>__('owner'),'non_occupant_owner'=>__('non_occupant_owner')),'key'=>true)), 
            'energy' => new mfValidatorChoice(array('choices'=>array('electricity'=>__('electricity'),'combustible'=>__('combustible')),'key'=>true)), 
            'number_of_people' => new mfValidatorNumber(array('required'=>false)), 
            'income' => new mfValidatorI18nCurrency(), 
//            'site_id' => new mfValidatorChoice(array('choices'=> MarketingLeadsWpLandingPageSiteUtils::getSitesForSelectForm()->toArray(),"key"=>true)),
        ));
    }
}

