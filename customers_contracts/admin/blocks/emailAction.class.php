<?php

class customers_contracts_emailActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $this->_contract=$this->getParameter('contract');
       $model_i18n=$this->getParameter('model_i18n');
       CustomerContractModelParameters::loadParametersForEmail($this->_contract,$this);
       // Body
       $this->body=$model_i18n->get('body');        
       $this->getEventDispather()->notify(new mfEvent($this, 'customers.contracts.email.build','customer'));    
    } 
    
    function getContract()
    {
        return $this->_contract;
    }
}