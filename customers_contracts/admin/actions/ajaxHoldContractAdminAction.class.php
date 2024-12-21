<?php


class customers_contracts_ajaxHoldContractAdminAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                            
          $item=new CustomerContract($request->getPostParameter('Contract'));                       
      //     if (!$item->isUserAuthorized($this->getUser()))
     //          $this->forwardTo401Action(); 
          $item->setHoldAdmin();                  
          $item->setComments($this->getUser(),'hold_admin');
       //   $item->updateAssistant($this->getUser());          
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'contract.hold_admin'));                     
          $response = array("action"=>"HoldContractAdmin",
                            "id" =>$item->get('id'),
                         //   "confirmated_at"=>$item->getDateTimeConfirmedAt(),
                            "info"=>__("Contract is hold."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
