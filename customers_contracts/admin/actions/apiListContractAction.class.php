<?php

// www.ecosol16.net/api/customers/contracts/admin/ListContract
require_once __DIR__."/../locales/Api/FormFilters/ContractApiFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/CustomerContractsPager.class.php";
require_once __DIR__."/../locales/Api/ContractListFormatterApi.class.php";

class customers_contracts_apiListContractAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();   
         if (!$this->getUser()->hasCredential([['superadmin','api_v1_customer_contract_list']]))
             $this->forwardTo401Action ();
         $data = new ContractListFormatterApi($this);               
         return $data->toArray();
    
    }

}
