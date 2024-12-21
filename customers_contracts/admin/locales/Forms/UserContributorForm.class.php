<?php

class UserContributorForm extends mfForm {
    
    static $attributions=null;
           
    function configure()
    {                       
       if (!self::$attributions)       
            self::$attributions=UserAttributionUtils::getAttributionsForI18nSelect();       
       $this->setValidators(array(                         
           'attribution_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"")+self::$attributions)),            
       ));
    }
}
