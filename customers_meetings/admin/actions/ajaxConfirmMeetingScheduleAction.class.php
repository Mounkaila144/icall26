<?php


class customers_meetings_ajaxConfirmMeetingScheduleAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {        
          $item=new CustomerMeeting($request->getPostParameter('Meeting'));   
           //     if (!$item->isUserAuthorized($this->getUser()))
     //          $this->forwardTo401Action(); 
          $item->setConfirmed($this->getUser());              
          $item->setComments($this->getUser());
          $item->updateAssistant($this->getUser());
          $item->save();
          $response = array("action"=>"ConfirmMeeting",
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
