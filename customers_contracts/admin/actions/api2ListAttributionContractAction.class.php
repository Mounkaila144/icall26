<?php
// www.ecosol16.net/admin/api/v2/customers/contracts/admin/ListAttributionContract

 
class customers_contracts_api2ListAttributionContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','contract_turnover_tax_rate_hidden','contract_turnover_tax_rate_remove',
                                                         'api2_contract_list_attribution'))))
            $this->forwardTo401Action();    
        return UserAttributionUtils::getAttributionsForI18nSelect();
    }

}
