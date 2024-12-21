<?php

/*
 * Generated by SuperAdmin Generator date : 07/06/13 10:57:11
 */
 
class customers_meetings_ajaxDeleteMeetingScheduleAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {                
         $item=new CustomerMeeting($request->getPostParameter('Meeting'));
         if (!$item->isUserAuthorized($this->getUser()))
            $this->forwardTo401Action();    
         if ($item->isLoaded())
         {    
            $item->set('status','DELETE');
            $item->save();
            $item->setComments($this->getUser(), 'delete');      
            // TODO 
            // get number of meetings for day
            // get number of meeting confirmed for day
             // get number of meetings for week
            // get number of meeting confirmed for week
            $response = array("action"=>"DeleteMeetingSchedule",
                              "id" =>$item->get('id')
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
