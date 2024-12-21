<?php


class DomoprimeRegionPriceForClassNewForm extends mfForm {
         
    
    
    function configure()
    {
         $this->setValidators(array(
            'number_of_people'=>new mfValidatorInteger(),
            'price'=>new mfValidatorI18nCurrency(),           
            'region_id' => new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__(""))+DomoprimeRegion::getRegionForSelect())),
         ));
    }
}


