<?php


class customers_meetings_ajaxHoldQuoteMeetingAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                            
          $item=new CustomerMeeting($request->getPostParameter('Meeting'));                       
      //     if (!$item->isUserAuthorized($this->getUser()))
     //          $this->forwardTo401Action(); 
          $item->setHoldQuote();                  
          $item->setComments($this->getUser(),'hold_quote');
       //   $item->updateAssistant($this->getUser());          
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'meeting.hold_quote'));                     
          $response = array("action"=>"HoldQuoteMeeting",
                            "id" =>$item->get('id'),
                         //   "confirmated_at"=>$item->getDateTimeConfirmedAt(),
                            "info"=>__("Meeting is hold by quotation."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
