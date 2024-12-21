<?php

class customers_contracts_emailChangesForSaleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $this->contract_base=$this->getParameter('contract');
       $user=$this->getParameter('user');
       $model_i18n=$this->getParameter('model_i18n');
       $this->user=$user->toArray();     
       $this->body=$model_i18n->get('body');         
       CustomerContractModelParameters::loadParametersWithChangesForEmail($this->contract_base,$this);      
       $this->getEventDispather()->notify(new mfEvent($this, 'customers.contracts.email.build','sale'));      
    } 
    
    function getContract()
    {
        return $this->contract_base;
    }
}