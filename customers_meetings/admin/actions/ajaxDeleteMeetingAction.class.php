<?php

/*
 * Generated by SuperAdmin Generator date : 07/06/13 10:57:11
 */
 
class customers_meetings_ajaxDeleteMeetingAction extends mfAction {
    
   
    
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
            $item->getCustomer()->disable();
            $item->setComments($this->getUser(), 'delete');           
            $response = array("action"=>"DeleteMeeting",
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

