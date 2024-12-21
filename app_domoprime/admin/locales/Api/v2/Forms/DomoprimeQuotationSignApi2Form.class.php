<?php

class DomoprimeQuotationSignApi2Form extends mfForm {

    protected $user=null;
            
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
        return $this['quotation_id']->getValue();
    }
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);           
        $this->setValidators(array(
            'quotation_id'=>new ObjectExistsValidator('DomoprimeQuotation',array('key'=>false)), 
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
            $this->getQuotation()->add(['signed_at'=>$this->getValue('signed_at'),'is_signed'=>'YES']);           
            return true;
        }   
        return false;
    }
}

