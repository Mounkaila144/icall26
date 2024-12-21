<?php


 
class customers_meetings_ajaxRemoveMeetingAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      if (!$this->getUSer()->hasCredential(array('superadmin','superadmin_debug')))
          $this->forwardTo401Action();
      try 
      {                
         $item=new CustomerMeeting($request->getPostParameter('Meeting'));           
         if ($item->isLoaded() && $item->get('status')=='DELETE')
         {              
            $this->getEventDispather()->notify(new mfEvent($item, 'meeting.remove'));  
            $item->delete();                
            $response = array("action"=>"RemoveMeeting",
                              "info"=>__("Meeting has been removed."),
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

