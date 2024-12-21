<?php

class customers_contracts_smsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $contract=$this->getParameter('contract');
       $model_i18n=$this->getParameter('model_i18n');
       $this->company= SiteCompanyUtils::getSiteCompany($contract->getSite())->toArray();                   
       $this->customer=$contract->getCustomer()->toArray();      
       $this->contract=$contract->toArray();           
       $this->message=$model_i18n->get('message');        
       CustomerContractModelParameters::loadParametersForSms($contract,$this);
       $this->getEventDispather()->notify(new mfEvent($this, 'customers.contracts.sms.build','customer'));      
    } 
    
    
}