<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/ListCampaignMeeting

 
class customers_meetings_api2ListCampaignMeetingAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_meeting_list_campaign','admin','meeting_modify_campaign','meeting_new_campaign'))))
            $this->forwardTo401Action(); 
         return CustomerMeetingUtils::getCampaignForSelect();
    }

}
