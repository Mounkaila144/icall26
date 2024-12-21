<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/ListAdminStatusContract

 
class customers_contracts_api2ListAdminStatusContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_admin_status','api2_contract_list_admin_status'))))
            $this->forwardTo401Action();        
        return CustomerContractAdminStatus::getStatusForI18nSelect();        
    }

}
