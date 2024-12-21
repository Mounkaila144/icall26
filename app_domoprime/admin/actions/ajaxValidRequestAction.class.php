<?php


class app_domoprime_ajaxValidRequestAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                            
          $item=new DomoprimeCalculation($request->getPostParameter('DomoprimeRequest'));                         
          $item->setAccepted($this->getUser());                        
          $item->save();                             
          $item->getMeeting()->set('state_id', CustomerMeetingSettings::load()->get('status_transfer_to_contract_id'))->save();          
          $this->getEventDispather()->notify(new mfEvent($item->getMeeting(), 'meeting.change'));      
          $response = array("action"=>"ValidRequest",
                            "id" =>$item->get('id'), 
                            "status"=>$item->getStatusI18n(),
                            "accepted_by"=>(string)$this->getUser()->getGuardUser()->getUpperName(),
                            "info"=>__("Request has been validated & transferred to contract."));
          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
