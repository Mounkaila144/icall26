<?php

// www.ecosol16.net/admin/api/v2/customers/meeting/forms/admin/GetFormsForContract

 
class customers_meetings_forms_api2GetFormsForContractAction extends mfAction {
    
           
    function execute(mfWebRequest $request) {             
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin', '*')
                ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');                   
        if (!$this->getUser()->hasCredential(array(array('superadmin', 'api2_customer_meeting_get_forms_for_contract'))))
            $this->forwardTo401Action();
        $messages = mfMessages::getInstance();          
        try {
            $response=new mfArray();
            $contract = new CustomerContract($request->getGetAndPostParameter('contract'));
            if ($contract->isNotLoaded())           
                throw new mfException('Contract is invalid');   
            $forms = new CustomerMeetingForms($contract);
            return $forms->getDataI18nForDocumentApi();
             
        } catch (mfException $e) {
            $messages->addError($e);
        }
         return $messages->hasMessages('error')?array("errors"=>$messages->getDecodedErrors()):$response->toArray();
    }

}
