<?php

class CustomerContractEditDateFieldForm extends mfForm {
    
    
    function configure() {
        $this->setValidators(array(
            'field'=>new mfValidatorChoice(array('choices'=>array('opc_at','pre_meeting_at','opened_at','doc_at','quoted_at','billing_at','sav_at'))),
            'id'=>new ObjectExistsValidator('CustomerCOntract',array('key'=>false)),            
        ));
    }
    
    function getContract()
    {
        return $this['id']->getValue();
    }
    
    function hasDate()
    {
        return $this->getCOntract()->get($this['field']->getValue());
    }
    
    function getMethod()
    {
        return "get".ucfirst(str_replace(array("_","at"),array("","At"),$this['field']->getValue()));
    }
    
    function getDate()
    {
        $method=$this->getMethod();
        return $this->getContract()->getFormatter()->$method();                
    }
}

