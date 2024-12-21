<?php


class customers_meetings_ajaxGetStateLocksAction extends mfAction {
                 
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                                               
      try 
      {                
         $validator=new mfValidatorSchemaForEach(new mfValidatorInteger(),count($request->getPostParameter('Meetings')));
         $selection=$validator->isValid($request->getPostParameter('Meetings'));         
         $response=array('action'=>'GetStateLocks',
                         'locks'=>CustomerMeetingUtils::getStateLocks($this->getUser()->getGuardUser(),$selection));
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
