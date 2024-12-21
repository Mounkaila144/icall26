<?php


class customers_contracts_ajaxFreeQuoteContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
          $item=new CustomerContract($request->getPostParameter('Contract'));            
          $item->setUnHoldQuote();
          $item->setComments($this->getUser(),'unhold_quote');
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'contract.unhold_quote'));                     
          $response = array("action"=>"FreeQuoteContract",
                            "id" =>$item->get('id'),
                            "info"=>__("Contract is unhold by quotation.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
