<?php


class customers_meetings_ajaxCancelMeetingScheduleAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
          $item=new CustomerMeeting($request->getPostParameter('Meeting'));            
          $item->setCancelled();
          $item->save();
          $response = array("action"=>"CancelMeeting",
                            "id" =>$item->get('id'),
                            "date"=>$item->getDate(),
                            "number_of_confirmed_meetings"=>$item->getFormattedNumberOfConfirmedMeetings(),
                           );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
