<?php

// www.ecosol16.net/admin/api/v2/customers/meeting/forms/admin/GetFormsForMeeting

 
class customers_meetings_forms_api2GetFormsForMeetingAction extends mfAction {
    
           
    function execute(mfWebRequest $request) {             
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin', '*')
                ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');                   
        if (!$this->getUser()->hasCredential(array(array('superadmin', 'api2_customer_meeting_get_forms_for_meeting'))))
            $this->forwardTo401Action();
        $messages = mfMessages::getInstance();          
        try {
            $response=new mfArray();
            $meeting = new CustomerMeeting($request->getGetAndPostParameter('meeting'));
            if ($meeting->isNotLoaded())           
                throw new mfException('Meeting is invalid');   
            $forms = new CustomerMeetingForms($meeting);
            return $forms->getDataI18nForDocumentApi();
             
        } catch (mfException $e) {
            $messages->addError($e);
        }
         return $messages->hasMessages('error')?array("errors"=>$messages->getDecodedErrors()):$response->toArray();
    }

}
