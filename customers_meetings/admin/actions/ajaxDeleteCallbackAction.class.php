<?php


class customers_meetings_ajaxDeleteCallbackAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {                
         $item=new CustomerMeeting($request->getPostParameter('Meeting'));
         if (!$item->isUserAuthorized($this->getUser()))
            $this->forwardTo401Action();            
         if ($item->isLoaded())
         {    
            $item->removeCallback();
            $response = array("action"=>"DeleteCallback",
                              "id" =>$item->get('id'),
                              "info"=>__("Callback has been deleted.")
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

