<?php

class CustomerContractPartnerForm extends mfForm {
    
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
        $this->setValidators(array(
             'contract_id'=>new ObjectExistsValidator('CustomerContract',array('key'=>false)),
             'partner_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("No partner"))+ PartnerUtils::getPartnersForSelect())),
        ));
    }
    
    function getContract()
    {
        return $this['contract_id']->getValue();
    }
    function getPartner()
    {
        return $this['partner_id']->getValue();
    }

}