<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/ListCallcenterMeeting

 
class customers_meetings_api2ListCallcenterMeetingAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
           $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_meeting_list_callcenter'))))
            $this->forwardTo401Action();           
        return Callcenter::getCallcenterForSelect();
    }

}
