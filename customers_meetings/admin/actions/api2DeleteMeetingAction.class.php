<?php

// www.ecosol16.net/admin/api/v2/meetings/admin/DeleteMeeting

class customers_meetings_api2DeleteMeetingAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin', '*')
                ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        $messages = mfMessages::getInstance();
         if (!$this->getUser()->hasCredential(array(array('superadmin','api2_meeting_delete'))))
            $this->forwardTo401Action();          
        try {
            //$user=new mfValidatorInteger();
            $meeting = new CustomerMeeting($request->getGetParameter('id'));
            if ($meeting->isLoaded()) {
                $meeting->set('status','DELETE');
            $meeting->save();
            $meeting->getCustomer()->disable();
            $meeting->setComments($this->getUser(), 'delete');    
                $response = array("id" => $meeting->get('id'));
            } else {
                $response['errors'] = __('Meeting is invalid.');
            }
        } catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error') ? array("error" => $messages->getDecodedErrors()) : $response;
        
    }

}
