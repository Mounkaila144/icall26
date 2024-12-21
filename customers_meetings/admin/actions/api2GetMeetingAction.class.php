<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/GetMeeting
 
require_once __DIR__."/../locales/Api/v2/Formatters/CustomerMeetingItemFormatterApi2.class.php";

class customers_meetings_api2GetMeetingAction extends mfAction {    
    
    function execute(mfWebRequest $request){
        if (!$this->getUser()->hasCredential([['superadmin','api2_meeting_get']]))
             $this->forwardTo401Action();
        $response=new mfArray();
        $item=new CustomerMeeting($request->getGetAndPostParameter('id'));
      
        if ($item->isNotLoaded())
            return $response->set('error','Meeting is invalid')->toArray();
        /*if (!$item->isAuthorized('view'))
            $this->forwardTo401Action();*/
        $response->set('data',$item->getFormatter()->toArrayForApi2()->toArray());
        return $response->toArray();
    }

}
