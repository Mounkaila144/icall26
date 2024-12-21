<?php


class customers_contracts_ajaxHoldQuoteContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                            
          $item=new CustomerContract($request->getPostParameter('Contract'));                       
      //     if (!$item->isUserAuthorized($this->getUser()))
     //          $this->forwardTo401Action(); 
          $item->setHoldQuote();                  
          $item->setComments($this->getUser(),'hold_quote');
       //   $item->updateAssistant($this->getUser());          
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'contract.hold_quote'));                     
          $response = array("action"=>"HoldQuoteContract",
                            "id" =>$item->get('id'),
                         //   "confirmated_at"=>$item->getDateTimeConfirmedAt(),
                            "info"=>__("Contract is hold by quotation."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
