<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/ListCompanyMeeting

 
class customers_meetings_api2ListCompanyMeetingAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_meeting_list_company'))))
            $this->forwardTo401Action();          
        return CustomerMeetingCompany::getActiveCompaniesForSelect()->toArray();
    }

}
