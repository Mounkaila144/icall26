<?php

// www.ecosol16.net/admin/api/v2/customers/meeting/forms/admin/UpdateFormsForContract

require_once __DIR__."/../locales/Forms/CustomerMeetingViewFormsForContractForm.class.php";    

class CustomerMeetingViewFormsForContractApi2Form extends CustomerMeetingViewFormsForContractForm {
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);             
        parent::configure();
        unset($this['id']);
    }
    
}

class customers_meetings_forms_api2UpdateFormsForContractAction extends mfAction {
    
           
    function execute(mfWebRequest $request) {             
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin', '*')
                ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');                   
        if (!$this->getUser()->hasCredential(array(array('superadmin', 'api2_customer_meeting_update_forms_for_contract'))))
            $this->forwardTo401Action();
        $messages = mfMessages::getInstance();          
        try {
            $response=new mfArray();
            $contract = new CustomerContract($request->getGetAndPostParameter('contract'));
            if ($contract->isNotLoaded())           
                throw new mfException('Contract is invalid');       
            if (!$request->getGetAndPostParameter('forms'))
                  throw new mfException('Forms parameters are empty');       
            $form = new CustomerMeetingViewFormsForContractApi2Form($this->getUser(), $contract, $request->getGetAndPostParameter('forms'));
            if (!$form->hasFields() && $contract->isHold()) 
                throw new mfException('Contract is hold.');            
            $form->bind($request->getGetAndPostParameter('forms'));
            if ($form->isValid()) {
                $form->getForms()->save();
                $this->getEventDispather()->notify(new mfEvent($form->getForms(), 'meeting.form.update'));
                return $response->set('info','Information has been saved.')->toArray();
            } else {
                //var_dump($form->getErrorSchema()->getErrorsMessage());
                return $response->set('errors',$form->getErrorSchema()->getErrorsMessage())->toArray();
            }
        } catch (mfException $e) {
            $messages->addError($e);
        }
         return $messages->hasMessages('error')?array("errors"=>$messages->getDecodedErrors()):$response->toArray();
    }

}
