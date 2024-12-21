<?php


class customers_meetings_ajaxCancelMeetingAction extends mfAction {
    
       
    
  
        
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
                            "info"=>__("Meeting is cancelled.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
