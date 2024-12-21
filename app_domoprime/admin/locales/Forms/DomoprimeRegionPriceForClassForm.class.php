<?php


class DomoprimeRegionPriceForClassForm extends mfForm {
         
    
    
    function configure()
    {
         $this->setValidators(array(
            'id'=>new mfValidatorInteger(),
            'number_of_people'=>new mfValidatorInteger(),
            'price'=>new mfValidatorI18nCurrency(),           
            'region_id' => new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__(""))+DomoprimeRegion::getRegionForSelect())),
         ));
    }
}


