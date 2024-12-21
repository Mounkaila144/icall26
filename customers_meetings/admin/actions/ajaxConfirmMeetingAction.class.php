<?php


class customers_meetings_ajaxConfirmMeetingAction extends mfAction {
    
       
    
  
        
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
                            "confirmated_at"=>$item->getDateTimeConfirmedAt(),
                            "info"=>__("Meeting is confirmed."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
