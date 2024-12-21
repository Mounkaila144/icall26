<?php


class customers_meetings_ajaxFreeQuoteMeetingAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
          $item=new CustomerMeeting($request->getPostParameter('Meeting'));            
          $item->setUnHoldQuote();
          $item->setComments($this->getUser(),'unhold_quote');
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'contract.unhold_quote'));                     
          $response = array("action"=>"FreeQuoteMeeting",
                            "id" =>$item->get('id'),
                            "info"=>__("Meeting is unhold by quotation.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
