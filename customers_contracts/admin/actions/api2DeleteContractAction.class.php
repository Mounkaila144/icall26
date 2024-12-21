<?php

// www.ecosol16.net/admin/api/v2/customers/contracts/admin/DeleteContract

class customers_contracts_api2DeleteContractAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin', '*');
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept'); 
        $messages = mfMessages::getInstance();
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_contract_delete'))))
            $this->forwardTo401Action();  
        
        try {            
            $contract = new CustomerContract($request->getGetParameter('id'));
            if ($contract->isLoaded()) {
                $contract->set('status','DELETE')->save();
                $contract->setComments($this->getUser(), 'delete');              
                $response = array("id" => $contract->get('id'));
            } else {
                $response['errors'] = __('Contract is invalid.');
            }
        } catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error') ? array("error" => $messages->getDecodedErrors()) : $response;
        
    }

}
