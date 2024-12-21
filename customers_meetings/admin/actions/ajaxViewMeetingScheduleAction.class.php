<?php


class customers_meetings_ajaxViewMeetingScheduleAction extends mfAction {

  
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();                  
        $this->user=$this->getUser();
        try
        {
             $this->meeting=new CustomerMeeting($request->getPostParameter('id'));                         
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
   
    }
    
}    