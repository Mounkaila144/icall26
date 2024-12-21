<?php

class customers_contracts_emailForSaleActionComponent extends mfActionComponent {
          
          
    
    function execute(mfWebRequest $request)
    {              
       $contract=$this->getParameter('contract');
       $user=$this->getParameter('user');
       $model_i18n=$this->getParameter('model_i18n');
       $this->user=$user->toArray();     
       $this->body=$model_i18n->get('body');         
       CustomerContractModelParameters::loadParametersForEmail($contract,$this);      
       $this->getEventDispather()->notify(new mfEvent($this, 'customers.contracts.email.build','sale'));      
    } 
    
}