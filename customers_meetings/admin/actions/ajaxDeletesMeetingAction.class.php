<?php


class customers_meetings_ajaxDeletesMeetingAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {                
          $validator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('Selection')));
          $validator->isValid($request->getPostParameter('Selection'));              
          $meetings= new CustomerMeetingCollection($request->getPostParameter('Selection'));
          $meetings->setStatusDelete();                  
          $response = array("action"=>"DeletesMeeting",
                            "info"=>__("Meetings have been deleted."),
                            "parameters" =>$request->getPostParameter('Selection'));
      } 
      catch (mfException $e) {
           $messages->addError($e);        
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

