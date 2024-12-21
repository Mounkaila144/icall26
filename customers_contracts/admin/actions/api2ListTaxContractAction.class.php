<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/ListTaxContract

 
class customers_contracts_api2ListTaxContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_contract_list_tax'))))
            $this->forwardTo401Action();    
        if ($this->getUser()->hasCredential(array(array('contract_turnover_tax_rate_hidden','contract_turnover_tax_rate_remove'))))
            return array();
        return TaxUtils::getTaxesForSelect();
    }

}
