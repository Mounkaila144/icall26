<?php


class customers_meetings_ajaxCreateContractAction extends mfAction {
    
                     
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                  
          $meeting=new CustomerMeeting($request->getPostParameter('Meeting'));                       
          if ($meeting->isNotLoaded())
              throw new mfException(__('Meeting is invalid.'));
          $contract=new CustomerContract($meeting);              
          $contract->set('state_id',CustomerContractSettings::load()->get('default_status_id'));
          $contract->toContract($this->getUser());
          $this->getEventDispather()->notify(new mfEvent($contract, 'contract.change',array('action'=>'to_contract')));   
          $response = array("action"=>"MeetingToContract",
                            "id" =>$meeting->get('id'),                           
                            "info"=>__("Contract has been created."));
          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
