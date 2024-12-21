<?php


class customers_meetings_ajaxReleaseMeetingLockAction extends mfAction {
                 
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                                               
      try 
      {                
        $meeting=new CustomerMeeting($request->getPostParameter('Meeting')); 
        $user=$this->getUser();            
        $meeting->releaseLockForUser($user->getGuardUser());  
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
