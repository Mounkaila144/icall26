<?php

//  www.ecosol34.net/admin/api/customers/contracts/admin/NewContract

require_once __DIR__."/../locales/Api/ContractNewFormatterApi.class.php";

class customers_contracts_apiNewContractAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();                                                   
        $data = new ContractNewFormatterApi($this);  
        return $data->toArray();
        
    }
    
}
