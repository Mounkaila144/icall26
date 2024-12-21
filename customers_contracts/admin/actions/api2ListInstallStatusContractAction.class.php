<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/ListInstallStatusContract

 
class customers_contracts_api2ListInstallStatusContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');     
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_contract_list_install_status'))))
            $this->forwardTo401Action();
        /*if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_modify_admin_status'))))*/
            return CustomerContractAdminStatus::getStatusForI18nSelect();
        return array();
    }

}
