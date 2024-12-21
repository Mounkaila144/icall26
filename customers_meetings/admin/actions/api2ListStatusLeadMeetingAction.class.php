<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/ListStatusLeadMeeting

 
class customers_meetings_api2ListStatusLeadMeetingAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_meeting_list_status_lead','admin','meeting_modify_callstatus','meeting_new_callstatus'))))
            $this->forwardTo401Action(); 
        return CustomerMeetingStatusCall::getStatusForI18nSelect();
    }

}
