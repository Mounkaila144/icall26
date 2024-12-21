<?php


class app_domoprime_ajaxGetClassFromMeetingAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
      $messages = mfMessages::getInstance();   
      try 
      {
          $meeting=new CustomerMeeting($request->getPostParameter('CustomerMeeting'));
          if ($meeting->isNotLoaded())        
              throw new mfException(__("Meeting is invalid."));
          $engine=new DomoprimeEngine($meeting);
          $engine->process();        
          $response = array("action"=>"GetClassFromMeeting",
                            "class"=>(string)$engine->getClass()->getI18n()
                        
                        );
           
         
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
