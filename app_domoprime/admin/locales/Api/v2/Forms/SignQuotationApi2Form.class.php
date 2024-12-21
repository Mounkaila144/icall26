<?php

class SignQuotationApi2Form extends mfForm {

    protected $user=null;
    protected $quotation=null;
            
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user = $user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getQuotation()
    {
        return $this->quotation;
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);           
        $this->setValidators(array(
            'quotation_id'=>new mfValidatorString(), 
            'signed_at'=>new mfValidatorDate(array('with_time'=>true)), 
        ));   
    }

    function isValid()
    {
        if (parent::isValid())
        {
            if ($this->processed)
                return true;
            $this->processed=true;
            $this->quotation = new DomoprimeQuotation($this->getValue('quotation_id'));
            $this->quotation->set('signed_at',$this->getValue('signed_at'));
            $this->quotation->set('is_signed','YES');
            $this->quotation->save();
            return true;
        }   
        return false;
    }
}

