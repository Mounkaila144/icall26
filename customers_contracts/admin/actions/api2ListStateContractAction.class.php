<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/ListStateContract

 
class customers_contracts_api2ListStateContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_contract_list_state','contract_modify_state'))))
            $this->forwardTo401Action();    
        return CustomerContractStatusUtils::getStatusForI18nSelect();        
    }

}
