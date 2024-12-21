<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/NewMeeting
require_once __DIR__."/../locales/Api/v2/Forms/CustomerMeetingApi2NewForm.class.php";

class customers_meetings_api2NewMeetingAction extends mfAction {

    function execute(mfWebRequest $request) {        
          $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');                                    
        if (!$this->getUser()->hasCredential([['superadmin','api2_user_customer_meeting_new']]))
             $this->forwardTo401Action();
        $form = new CustomerMeetingApi2NewForm($this->getUser(),$request->getPostParameters());
        $form->bind($request->getPostParameters());
        if ($form->isValid())           
            return $form->toArray();                    
        else
        {           
            if (!$request->getPostParameters())
                  return array('errors'=>array('code'=>1,'text'=>'Data is empty'));
            return $form->toArray();    
        }            
    }

}
