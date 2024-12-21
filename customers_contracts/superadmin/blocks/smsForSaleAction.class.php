<?php

class customers_contracts_smsForSaleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $contract=$this->getParameter('contract');
       $user=$this->getParameter('user');
       $model_i18n=$this->getParameter('model_i18n');       
       $this->user=$user->toArray();                                
       $this->message=$model_i18n->get('message');           
       CustomerContractModelParameters::loadParametersForSms($contract,$this);
       $this->getEventDispather()->notify(new mfEvent($this, 'customers.contracts.sms.build','sale'));      
    } 
    
    
}