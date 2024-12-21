<?php


class CustomerContractPollutingViewForm extends CustomerContractPollutingCompanyBaseForm{
    
    protected $user=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {
        parent::configure();
        unset($this['country']);
        if ($this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_polluter_view_type'))))
           $this->setValidator('type',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>DomoprimePollutingCompany::getTypes()->unshift(array(''=>'')))));
    }
}
