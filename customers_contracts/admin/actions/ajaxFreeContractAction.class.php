<?php


class customers_contracts_ajaxFreeContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
          $item=new CustomerContract($request->getPostParameter('Contract'));            
          $item->setUnHold();
          $item->setComments($this->getUser(),'unhold');
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'contract.unhold'));                     
          $response = array("action"=>"FreeContract",
                            "id" =>$item->get('id'),
                            "info"=>__("Contract is unhold.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
