<?php


class DomoprimePolluterClassPricingViewForm extends DomoprimePolluterClassBaseForm {
         
    protected $user=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {
         parent::configure();
         $this->setValidator('class_id',new mfValidatorChoice(array('key'=>true,'choices'=>DomoprimeClass::getClassForI18nSelect())));   
         if ($this->getUser()->hasCredential(array(array('app_domoprime_settings_polluter_class_pricing_max_limit','superadmin'))))
             $this->setValidator('max_limit',new mfValidatorI18nNumber(array('required'=>false)));
    }
}

