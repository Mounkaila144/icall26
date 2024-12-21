<?php


class customers_meetings_ajaxRecyclesMeetingAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {                
          $validator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('Selection')));
          $validator->isValid($request->getPostParameter('Selection'));              
          $meetings= new CustomerMeetingCollection($request->getPostParameter('Selection'));
     //   echo "<pre>";  var_dump($meetings); echo "</pre>";
          $meetings->setStatusActive();                  
          $response = array("action"=>"RecyclesMeeting",
                            "info"=>__("Meetings have been recycled."),
                            "parameters" =>$request->getPostParameter('Selection'));
      } 
      catch (mfException $e) {
           $messages->addError($e);        
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

