<?php
// www.ecosol16.net/admin/api/meeting/admin/ListMeeting

require_once dirname(__FILE__)."/../locales/Api/v1/FormFilters/CustomerMeetingApiFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsPager.class.php";
require_once dirname(__FILE__)."/../locales/Api/v1/CustomerMeetingListFormatterApi.class.php";

class customers_meetings_apiListMeetingAction extends mfAction {

    function execute(mfWebRequest $request) {        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();                                
        if (!$this->getUser()->hasCredential([['superadmin','api_v1_customer_meeting_list']]))
             $this->forwardTo401Action ();
        $data = new CustomerMeetingListFormatterApi($this);               
        return $data->toArray();
    }

}