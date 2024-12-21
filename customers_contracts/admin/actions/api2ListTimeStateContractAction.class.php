<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/ListTimeStateContract

 
class customers_contracts_api2ListTimeStateContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_contract_list_time_state','contract_modify_time_state'))))
            $this->forwardTo401Action();    
        return CustomerContractTimeStatus::getStatusForI18nSelect();        
    }

}
