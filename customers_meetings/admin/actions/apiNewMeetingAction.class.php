<?php
// www.ecosol16.net/admin/api/meeting/admin/NewMeetingUser

 
class customers_meetings_apiNewMeetingUserAction extends mfAction {

    function execute(mfWebRequest $request) {        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*');
        $messages = mfMessages::getInstance();                                
        if (!$this->getUser()->hasCredential([['superadmin','api_user_customer_meeting_new']]))
             $this->forwardTo401Action ();
       // $data = new CustomerMeetingListFormatterApi($this);               
      //  return $data->toArray();
    }

}
