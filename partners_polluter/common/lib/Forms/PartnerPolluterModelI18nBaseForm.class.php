<?php



 class PartnerPolluterModelI18nBaseForm extends mfFormSite {
    
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
   
    function configure()
    {
        $this->setValidators(array(
             'id'=>new mfValidatorInteger(),
            'value'=>new mfValidatorString(array('max_length'=>128)),
            'content'=>new mfValidatorString(array('max_length'=>32768)),
            'comments'=>new mfValidatorString(array('max_length'=>16000,'required'=>false)),
            "lang"=> new LanguagesExistsValidator(array(),'frontend',$this->getSite()),             
        ));
    }
    
 
}


